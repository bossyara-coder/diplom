<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Скейтборд GIRL - hello kitty',
            'price' => 8000,
            'image' => 'products/hello_kit1.jpg', // Убедись, что файл лежит в public/image/
            'category' => 'skateboards' // Эта категория пойдет в data-category
        ]);

        Product::create([
            'name' => 'Футболка "THRASHER"',
            'price' => 1500,
            'image' => 'products/trshr.png',
            'category' => 'clothing'
        ]);

        Product::create([
            'name' => 'Подвески Severed Hollow Lights Thunder (2/2)',
            'price' => 8550,
            'image' => 'products/pod.jpg',
            'category' => 'complect'
        ]);
    
        // Добавь еще пару товаров по аналогии
    }
}
