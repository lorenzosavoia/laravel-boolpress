<?php

namespace App\Model;

use illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    static public function createSlug($title)
    {
        $slug = Str::slug($title, '-');
        $postPresente = Post::where('slug', $slug)->first(); //controllo se lo slug e'univoco

        $counter = 0;
        while ($postPresente) {
            $newSlug = $slug . '-' . $counter;
            $postPresente = Post::where('slug', $newSlug)->first();
            $counter++;
        }
        return (empty($newSlug)) ? $slug : $newSlug;
    }
}
