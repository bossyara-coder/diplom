<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating; // Импортируем модель рейтинга для работы с оценками
use Illuminate\Support\Facades\Auth; // Импортируем фасад Auth для проверки авторизации
use App\Models\Comment;


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
        // Подгружаем товар вместе со всеми связанными оценками из таблицы ratings
        $product = Product::with('ratings')->findOrFail($id);
        

        // Загружаем только главные комментарии (без parent_id), вместе с ответами и авторами, сортируем от новых к старым
        $comments = $product->comments()->whereNull('parent_id')->with(['user', 'replies.user'])->latest()->get();


        // Рассчитываем среднюю оценку товара (если оценок нет, вернет 0)
        $averageRating = $product->ratings()->avg('rating') ?? 0;
        
        // Получаем общее количество выставленных оценок
        $ratingsCount = $product->ratings()->count();
        
        // Собираем статистику распределения оценок (сколько штук 5 звезд, 4 звезды и т.д.)
        $breakdown = [];
        for ($i = 5; $i >= 1; $i--) {
            $breakdown[$i] = $product->ratings()->where('rating', $i)->count();
        }

        // Проверяем, ставил ли текущий залогиненный пользователь оценку этому товару ранее
        $userRating = Auth::check() ? $product->ratings()->where('user_id', Auth::id())->value('rating') : 0;
    
        // Передаем сам товар и всю аналитику рейтинга в шаблон карточки товара
        return view('product', compact('product', 'averageRating', 'ratingsCount', 'breakdown', 'userRating', 'comments'));
    }

    /**
     * Логика сохранения или изменения оценки товара
     */
    public function rate(Request $request, $id)
    {
        // Проверяем входящие данные: оценка обязательна, должна быть целым числом от 1 до 5
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        // Убеждаемся, что товар с таким ID существует
        $product = Product::findOrFail($id);

        // Ищем в базе оценку от этого пользователя для этого товара.
        // Если она уже есть — метод обновит значение поля rating (изменение оценки).
        // Если ее нет — метод создаст новую запись в таблице ratings.
        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(), 
                'product_id' => $product->id
            ],
            [
                'rating' => $request->rating
            ]
        );

        // Возвращаем пользователя на предыдущую страницу с сессионным сообщением об успехе
        return back()->with('success', 'Ваша оценка сохранена!');
    }






    // НОВЫЙ МЕТОД: Сохранение комментария/ответа
    public function storeComment(Request $request, $id)
    {
        $request->validate(['content' => 'required|string|max:1000']);

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'parent_id' => $request->parent_id, // будет null для обычных комментариев
            'content' => $request->content
        ]);

        return back()->with('success', 'Комментарий опубликован!');
    }

    // НОВЫЙ МЕТОД: Удаление комментария (с проверкой прав)
    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);

        // Проверяем: является ли пользователь автором ИЛИ является ли он админом (проверь название колонки админа, обычно role или is_admin)
        if (Auth::id() === $comment->user_id || Auth::user()->role === 'admin') {
            $comment->delete();
            return back()->with('success', 'Комментарий удален!');
        }

        return back()->withErrors('У вас нет прав для удаления этого комментария.');
    }
}