<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Добавляем импорт модели

class CatalogController extends Controller
{
    public function index()
    {
        // Получаем все товары из базы данных
        $products = Product::all(); 
        
        // Передаем переменную $products в шаблон catalog.blade.php
        return view('catalog', compact('products'));
    }

    public function show($id)
    {
        // Ищем товар по ID. Если не найдет - Laravel сам выдаст красивую ошибку 404
        $product = \App\Models\Product::findOrFail($id);
    
        // Передаем переменную $product в новый шаблон
        return view('product', compact('product'));
    }

    
}
