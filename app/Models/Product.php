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
        'description'
    ];
}