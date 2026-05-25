<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Разрешаем массовое заполнение этих полей
    protected $fillable = [
        'name', 
        'price', 
        'image', 
        'category',
        'article', 
        'description'
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

