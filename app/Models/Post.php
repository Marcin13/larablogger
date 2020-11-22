<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

/**
 * @method static findOrFail ($id)         // to wszystko sam dodaje
 * @method static latest(string $string)  //a można te metody znaleźć
 * @method static Create(array $all)      // w dokumentacji Laravel
 * @method static oldest(string $string)
 * @method static published()            //metoda ta pochodzi z naszego
 * @method static firstOrFail(int $id)
 * @property mixed content               // Właściwości ta pochodzi z  scopePublished gdzie chcemy wyświetlać tylko opublikowane posty
 */

class Post extends Model implements Feedable
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','title' ,'type' ,'date', 'content', 'published','premium', 'image'];
    //protected $guarded = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates = ['date'];
    /**
     * @var mixed
     */
    public function setDateAttribute($value){

        $this->attributes['date'] = is_null($value)? now():$value;

    }
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 300);
    }
    public function getPhotoAttribute()
    {
        return Str::startsWith($this->image, 'http') ? $this->image : Storage::url($this->image);
    }

    public function scopePublished($query)
    {
        $user = auth()->user();
        if($user && $user->can('manage-posts')){
            return $query;
        }
        if(!$user){
            $query->where('premium', '<>', 1);  // to oznacza różne od 1 '<>'
        }
        return $query->where('published', 1);
    }
    /* Tu z automatu Laravel znalazł by User_id w tabeli Post.
    public function user(){
        return $this->belongsTo(User::class);
    }
  */
    public function author(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function tags()
    {
        //Można dodać dodatkowe parametry ale że zastosowaliśmy konwencje nazewniczą gdzie
        //tabele nazwaliśmy post_tag
        return $this->belongsToMany(Tag::class);
    }

    public function toFeedItem(): FeedItem
    {
        // TODO: Implement toFeedItem() method.
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->excerpt)
            ->updated($this->updated_at)
            ->link(route('posts.single', $this->slug))
            ->author($this->author->name);
    }
    // app/NewsItem.php

    public static function getFeedItems()
    {
        return Post::published()->get();
    }
    /*StackOverflow nex and previous */
    // in your model file
    public function next(){
        // get next post //firstOrFaill will generate 404
        return Post::published()->where('id', '>', $this->id)->first();

    }
    public  function previous(){
        // get previous  post // Tu musi być tak bo inaczej nie dziala
        return Post::published()->where('id', '<', $this->id)->orderBy('id','desc')->first();

    }
}
