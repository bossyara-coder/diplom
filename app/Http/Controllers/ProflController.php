<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProflController extends Controller
{
    public function index()
    {
        // Проверяем, авторизован ли пользователь
        if (Auth::check()) {
            $user = Auth::user(); 
            $purchases = []; // Ваша логика получения покупок 
            return view('profile', compact('user', 'purchases')); 
        }

        // Если гость — отправляем на регистрацию
        return redirect()->route('register'); 
    }

    // Обновление имени и аватарки
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Максимум 2MB
        ]);

        $user = Auth::user();

        // Проверяем, что $user — это экземпляр модели User
        if (!$user instanceof User) {
            return redirect()->route('profile')->with('error', 'Пользователь не найден.');
        }

        $user->name = $request->input('name');

        // Загрузка аватарки
        if ($request->hasFile('avatar')) {
            // Удаляем старую аватарку, если она есть
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            // Сохраняем новую аватарку
            $avatarPath = $request->file('avatar')->store('public/avatars');
            $user->avatar = basename($avatarPath);
        }

        // Сохраняем изменения
        $user->save();

        return redirect()->route('profile')->with('success', 'Профиль успешно обновлен!');
    }


    public function destroy(Request $request)
    {
        $user = Auth::user();

        // 1. Проверяем экземпляр модели [cite: 5]
        if (!$user instanceof \App\Models\User) {
        return redirect()->route('profile')->with('error', 'Ошибка при удалении пользователя.');
        }

        // 2. Удаляем аватарку из хранилища, если она установлена [cite: 7, 8]
        if ($user->avatar) {
            Storage::delete('public/avatars/' . $user->avatar);
        }

        // 3. Удаляем запись из базы данных
        $user->delete();

        // 4. Очищаем сессию (как в методе logout)
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 5. Перенаправляем на регистрацию с сообщением
        return redirect()->route('register')->with('success', 'Аккаунт успешно удален.');
    }
}