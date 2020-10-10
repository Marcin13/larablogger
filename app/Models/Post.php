<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static findOrFail ($id)
 * @method static latest(string $string)
 * @property mixed content /* Właściwości ta pochodzi z tabeli*/

class Post extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $dates = ['date'];
    /**
     * @var mixed
     */

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
}
