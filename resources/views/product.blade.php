<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} — TRAILBLAZE</title>
    <link rel="stylesheet" href="{{ asset('css/style-catalog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-product-page.css') }}">
    <meta name="auth-check" content="{{ Auth::check() ? 'true' : 'false' }}">
</head>
<body>

<div id="laravel-cart-data" data-cart='@json(session("cart", []))' style="display: none;"></div>

<header class="header">
    <div class="logo">
       <a href="{{ route('home') }}">
          <img src="{{ asset('image/TB.png') }}" alt="TRAILBLAZE">
       </a> 
    </div>

    <div class="header-kateg">
        <a href="{{ route('catalog') }}"><p>СКЕЙТБОРДЫ</p></a>
        <a href="{{ route('catalog') }}"><p>ОДЕЖДА</p></a>
        <a href="{{ route('catalog') }}"><p>ОБУВЬ</p></a>
        <a href="{{ route('catalog') }}"><p>АКССЕСУАРЫ</p></a>
    </div>

    <div class="search-container">
        <input type="text" id="search-input" placeholder="поиск товаров...">
        <button class="search-button" id="search-button">очистить</button>
    </div>

    <div class="nav-buttons">
        <div class="cart-icon-wrapper" id="cartBtn">
            <img src="{{ asset('image/korzina.svg') }}" alt="корзина">
            <span class="cart-count-badge">0</span>
        </div>
        <a href="{{ route('profl') }}">
            <img src="{{ asset('image/user.svg') }}" alt="Профиль">
        </a>
    </div>
</header>

<main class="product-page-main">
    <div class="product-detail-wrapper product-item" 
         data-id="{{ $product->id }}" 
         data-price="{{ $product->price }}" 
         data-category="{{ $product->category }}">
        
        <div class="product-gallery">
            <div class="main-img-container">
                <img class="product-img" src="{{ asset('image/products/' . basename($product->image)) }}" alt="{{ $product->name }}">
            </div>
        </div>

        <div class="product-info-column">
            <div class="product-meta">
                <span class="category-tag">{{ $product->category }}</span>
            </div>
            
            <h1 class="pr-title">{{ $product->name }}</h1>
            <div class="pr-price">{{ number_format($product->price, 0, '.', ' ') }} руб.</div>

            <div class="product-description">
                <h3>Описание товара</h3>
                <p>
                    {{ $product->description ?? 'Данный товар — идеальный выбор для ценителей качества и стиля TRAILBLAZE. Модель спроектирована с учетом современных стандартов комфорта и долговечности.' }}
                </p>
            </div>

            <div class="product-specs">
                <h3>Характеристики</h3>
                <ul>
                    <li><span>Категория:</span> <strong>{{ $product->category }}</strong></li>
                    <li><span>Артикул:</span> <strong>#{{ 1000 + $product->id }}</strong></li>
                    <li><span>Наличие:</span> <strong>На складе</strong></li>
                </ul>
            </div>

            <button data-cart type="button" class="cart_button buy-button">
                <h5>добавить в корзину</h5>
            </button>
        </div>
    </div>
</main>

<div class="cart-overlay" id="cartOverlay"></div>
<div class="cart-popup" id="cartPopup">
    <div class="cart-content">
        <div class="cart-header">
            <h2>Ваша корзина</h2>
            <button class="close-cart">&times;</button>
        </div>
        <div class="cart-items" id="cartItems"></div>
        <div class="cart-footer">
            <div class="cart-total">
                <span>Итого:</span>
                <span id="cartTotal">0</span> руб.
            </div>
            <div class="cart-buttons">
                <button class="checkout-btn" id="checkoutBtn" data-url="{{ route('register') }}">Оформить заказ</button>
                <button class="continue-shopping" id="continueShopping">Продолжить покупки</button>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="container-footer">
        <div class="for-client">
            <h1>Для покупателей</h1>
            <a href="">доставка</a> <br>
            <a href="">способы оплаты</a> <br>
            <a href="">вопросы и ответы</a> <br>
            <a href="">об упаковке товаров</a>
        </div>
        <div class="our-media">
            <h1>Наши соц сети</h1>
            <div class="img-media">
                <a href="https://www.instagram.com/"><img src="{{ asset('image/Instagram.svg') }}" alt=""></a>
                <a href="https://web.telegram.org/a/"><img src="{{ asset('image/Telegram.svg') }}" alt=""></a>
                <a href="https://m.vk.com/"><img src="{{ asset('image/Vk.svg') }}" alt=""></a>
                <a href="https://twitter.com"><img src="{{ asset('image/X.svg') }}" alt="" class="X-tw"></a>
            </div>
        </div>
    </div>
    <div class="copy">
        <p>2025 © TRAILBLAZE</p>
    </div>
</footer>

<script>
    window.Laravel = {
        csrfToken: '{{ csrf_token() }}',
        cartAddUrl: '{{ route("cart.add") }}'
    };
</script>

<script src="{{ asset('js/cart.js') }}"></script>
<script src="{{ asset('js/catalog.js') }}"></script>
</body>
</html>