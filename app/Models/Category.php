<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
    protected $fillable = [
        'name'
    ];
    public function books()
    {
        return $this->hasMany('App\Models\Book', 'book_category', '_id');
    }

    public static function filterCategory(){
       return Category::whereHas('books')->get();
    }
}
