<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Указываем, какие поля можно заполнять массово
    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * Связь: Одна категория может иметь много товаров.
     * Это пригодится тебе в будущем для фильтрации.
     */
    public function products()
    {
        // Если в таблице products ты переделаешь поле category на category_id
        return $this->hasMany(Product::class);
    }
}
