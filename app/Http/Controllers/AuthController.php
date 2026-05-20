<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cart;


class AuthController extends Controller
{
    public function showAuthForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // Переносим товары из сессии в базу сразу после регистрации
        $this->transferSessionCartToDb();

        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ПЕРЕНОС КОРЗИНЫ
            $this->transferSessionCartToDb();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'Неверный логин или пароль.',
        ]);
    }


    /**
     * Метод для переноса корзины из сессии (гостевой) в БД (для пользователя)
     */
    private function transferSessionCartToDb()
    {
        $sessionCart = session()->get('cart');

        if ($sessionCart) {
            foreach ($sessionCart as $productId => $details) {
                // Если товар уже есть в базе у этого юзера — обновим кол-во, если нет — создадим
                Cart::updateOrCreate(
                    [
                        'user_id' => Auth::id(),
                        'product_id' => $productId
                    ],
                    [
                        'quantity' => $details['quantity']
                    ]
                );
            }
            session()->forget('cart'); // Удаляем гостевую корзину из сессии
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('register');
    }
}
