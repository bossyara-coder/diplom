
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="{{asset('css/style-catalog.css')}}">
    <meta name="auth-check" content="{{ Auth::check() ? 'true' : 'false' }}">

</head>
<body>

<div id="laravel-cart-data" data-cart='@json(session("cart", []))' style="display: none;"></div>

<header class="header">
    <div class="logo">
       <a href="{{ route('home')}}">
          <img src="{{asset('image/TB.png')}}" alt="TRAILBLAZE">
          </a> 
    </div>

    <div class="header-kateg">
        <a href="{{ route('catalog') }}">
            <p>СКЕЙТБОРДЫ</p>  
         </a>
         <a href="{{ route('catalog') }}">
          <p>ОДЕЖДА</p>
         </a>
         <a href="{{ route('catalog') }}">
          <p>ОБУВЬ</p>
         </a>
         <a href="{{ route('catalog') }}">
         <p>АКССЕСУАРЫ</p>
         </a>
    </div>

    <div class="search-container">
        <input 
            type="text" 
            id="search-input" 
            placeholder="поиск товаров..."
            aria-label="поиск товаров">
        <button class="search-button" id="search-button">очистить</button>
    </div>

    <div class="nav-buttons">

        @if(auth()->check() && auth()->user()->is_admin)
        <a href="{{ route('admin.index') }}" class="admin-link-button">
            Панель управления
        </a>
        @endif


        <div class="cart-icon-wrapper">
            <img src="{{asset('image/korzina.svg')}}" alt="корзина" onclick="window.location.href='#'">
            <span class="cart-count-badge">0</span>
        </div>
        <a href="{{ route('profl') }}">
            <img src="{{asset('image/user.svg')}}" alt="Профиль" onclick="window.location.href='#'">
        </a>
    </div>
</header>

<div class="container">
    <h1>Каталог</h1>
        
    <div class="filters">
        <button class="filter-button active" data-filter="all">Все</button>
        <button class="filter-button" data-filter="clothing">Одежда</button>
        <button class="filter-button" data-filter="skateboards">Скейтборды</button>
        <button class="filter-button" data-filter="shoes">Обувь</button>
        <button class="filter-button" data-filter="complect">Комплектущие</button>
        <button class="price-sort" data-sort="asc">По возрастанию цены</button>
        <button class="price-sort" data-sort="desc">По убыванию цены</button>
    </div>

    <div class="products">
        @foreach($products as $product)
        <div class="product-item" 
            data-category="{{ $product->category }}" 
            data-id="{{ $product->id }}" 
            data-price="{{ $product->price }}">
        
            <div class="img-catalog">
                <a href="{{ route('product.show', $product->id) }}">
                    <img class="product-img" src="{{ asset('image/products/' . basename($product->image)) }}" alt="{{ $product->name }}">
                </a>
            </div>
        
            <div class="inf_prod_cart">
                <a href="{{ route('product.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                    <h2 class="pr-title">{{ $product->name }}</h2>
                </a>
                <p class="pr-price">Цена: {{ number_format($product->price, 0, '.', ' ') }} руб.</p>
                <button data-cart type="button" class="cart_button">
                    <h5>Добавить в корзину</h5>
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="cart-overlay" id="cartOverlay"></div>
<div class="cart-popup" id="cartPopup">
    <div class="cart-content">
        <div class="cart-header">
            <h2>Ваша корзина</h2>
            <button class="close-cart">&times;</button>
        </div>
        <div class="cart-items" id="cartItems">
            <div class="empty-cart-message">
                Ваша корзина пуста
            </div>
        </div>
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



    <footer >
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
              <a href="https://www.instagram.com/">
                <img src="{{ asset('image/Instagram.svg') }}" alt="">
              </a>
              <a href="https://web.telegram.org/a/">
                <img src="{{ asset('image/Telegram.svg') }}" alt="">
              </a>
              <a href="https://m.vk.com/">
                <img src="{{ asset('image/Vk.svg') }}" alt="">
              </a>
              <a href="https://twitter.com">
                <img src="{{ asset('image/X.svg') }}" alt="" class="X-tw">
              </a>
            </div>
            </div>
        </div>

        <div class="copy">
            <p>2025 © TRAILBLAZE</p>
        </div>
    </footer>

     <script>
     // Передаем данные из Laravel в JS глобально
    window.Laravel = {
        csrfToken: '{{ csrf_token() }}',
        cartAddUrl: '{{ route("cart.add") }}'
    };
    </script>
    <script src="{{ asset('js/catalog.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
     
</body>
</html>