<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>

    <link rel="stylesheet" href="{{asset('css/style-korz.css')}}">
</head>
<body>

<div id="laravel-cart-data" data-cart='{!! json_encode(session("cart", [])) !!}' style="display: none;"></div>

    <header>
        <div class="header-content">
            <div class="main-header">
                <div class="logo">
                    <a href="{{ route('home')}}">
                        <img src="{{asset('image/TB.png')}}" alt="TRAILBLAZE">
                    </a>  
                </div>
                <div class="cart-icon" id="cart-icon" >
                    <a href="{{ route('korz') }}">🛒</a>
                        <span class="cart-count">0</span>
                    <div class="nav-buttons">
                    <a href="{{ route('profl') }}">
                        <img src="{{asset('image/user.svg')}}" alt="Профиль" onclick="window.location.href='#'">
                    </a>
                    </div>
                </div>
                
            </div>
        </div>
    </header>

    
    
    <main class="container">
        <h1 class="cart-title">Ваша корзина</h1>
        
        <div class="products" id="products">
            <!-- Товары будут добавляться через JavaScript -->
        </div>
    </main>
    
    <!-- Корзина -->
    <div class="cart-container" id="cart-container">
        <div class="cart-header">
            <h2>Ваша корзина</h2>
            <button class="close-cart" id="close-cart">×</button>
        </div>
        
        <table class="cart-table" id="cart-table">
            <thead>
                <tr>
                    <th style="width: 40%;">Товар</th>
                    <th style="width: 15%;">Цена</th>
                    <th style="width: 20%;">Количество</th>
                    <th style="width: 15%;">Итого</th>
                    <th style="width: 10%;"></th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Товары в корзине будут добавляться через JavaScript -->
            </tbody>
        </table>
        
        <div class="cart-summary">
            <div class="summary-row">
                <span>Промежуточный итог</span>
                <span id="subtotal">0 ₽</span>
            </div>
            <div class="summary-row">
                <span>Доставка</span>
                <span>Бесплатно</span>
            </div>
            <div class="summary-row">
                <span>Общая сумма</span>
                <span id="cart-total">0 ₽</span>
            </div>
        </div>
        
        <div class="cart-actions">
            <a href="{{ route('catalog') }}" class="btn btn-continue"><p>Продолжить покупки</p></a>
            <a href="{{ route('catalog') }}" class="btn btn-checkout"><p>Оформить заказ</p></a>
        </div>
    </main>
</body>
</html>