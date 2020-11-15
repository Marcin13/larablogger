<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static firstOrCreate(array $array)
 */
class Tag extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    //protected $guarded = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
   // protected $dates = ['date'];
    /**
     * @var mixed
     */
    public function setNameAttribute($value){
        // Ta metoda ustawia nam "slug" z kopiowaliśmy ja z  Post.php tam ona też działa.
        // zmiany to setTitleAttribute -> setNameAttribute oraz 'title' -> 'name'.
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    public function posts(){
        //Można dodać dodatkowe parametry ale że zastosowaliśmy konwencje nazewniczą gdzie
        //tabele nazwaliśmy post_tag
        return $this->belongsToMany(Post::class);
    }
}
