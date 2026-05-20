<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class KorzController extends Controller
{


    // Метод для отображения корзины
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('korz', compact('cart'));
    }


    public function add(Request $request)
    {
        $productId = $request->id;
        $name = $request->name;
        $price = $request->price;
        $image = $request->image;
        $quantity = 1;

        if (Auth::check()) {
            // ДЛЯ АВТОРИЗОВАННЫХ:
            // Ищем, есть ли уже такой товар в корзине этого пользователя
            $cartItem = Cart::where('user_id', Auth::id())
                            ->where('product_id', $productId)
                            ->first();

            if ($cartItem) {
                // Если есть — просто прибавляем количество
                $cartItem->increment('quantity', $quantity);
            }
            else {
                // Если нет — создаем новую запись
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]);
            }
        }
        else {
            // ДЛЯ ГОСТЕЙ (в сессию)
            $cart = session()->get('cart', []);

            if(isset($cart[$productId])) {
                $cart[$productId]['quantity']++;
            }
                else {
                $cart[$productId] = [
                    "name" => $name,
                    "quantity" => $quantity,
                    "price" => $price,
                    "image" => $image
                ];
            }
            session()->put('cart', $cart);
        }

        return response()->json(['status' => 'success', 'message' => 'Товар добавлен']);
    }

    public function remove(Request $request)
    {
        // Получаем текущую корзину из сессии
        $cart = session()->get('cart', []);

        // Если товар с таким ID есть в корзине — удаляем его
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            // Сохраняем обновленную корзину обратно в сессию
            session()->put('cart', $cart);
        }

        return response()->json(['status' => 'success', 'message' => 'Товар удален из сессии']);
    }

    public function updateQuantity(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;
        $action = $request->action; // 'increase' или 'decrease'
    
        if(isset($cart[$id])) {
            if($action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif($action === 'decrease' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
            
            session()->put('cart', $cart);
        }
    
        return response()->json(['status' => 'success', 'newQuantity' => $cart[$id]['quantity'] ?? 0]);
    }
    
}
