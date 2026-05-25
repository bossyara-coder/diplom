<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="{{ asset('css/style-profl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-catalog.css') }}">
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


<div class="cont-body">
<div class="profile-container">
        <!-- Блок с формой для изменения информации -->
        <div class="profile-settings">
            <h1>Профиль</h1>

            <!-- Форма для изменения имени и аватарки -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="name">Имя:</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                <div>
                    <label for="avatar">Аватарка:</label>
                    <input type="file" id="avatar" name="avatar" onchange="previewAvatar(event)">
                </div>
                <button type="submit">Сохранить</button>
            </form>

            <!-- Раздел с покупками -->
            <div class="purchases-section">
                <h2>История покупок</h2>
                @if(empty($purchases))
                    <p>К сожалению, вы не совершили ни одной покупки на данный момент(</p>
                @else
                    <ul>
                        @foreach($purchases as $purchase)
                            <li>{{ $purchase->product->name }} - {{ $purchase->quantity }} шт. - {{ $purchase->total_price }} ₽</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <a href="{{ route('home') }}" class="home-link">На главную</a>

            <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
                @csrf
                <button type="submit" class="logout-button">Выйти из аккаунта</button>
            </form>

            <div class="danger-zone" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
                <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Вы уверены что хотите удалить аккаунт? Это действие необратимо, все данные будут стерты.');">
                    @csrf
                    @method('DELETE') 
                    <button type="submit" class="delete-account-btn">Удалить аккаунт</button>
                </form>
            </div>

        </div>

        <!-- Блок с примером аватарки -->
       
</div>

<div class="container-avatar">
    <div class="text">
        <p>Предпросмотр</p>
        </div>
        <div class="avatar-preview">
            @if($user->avatar)
                <img id="avatar-preview" src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Аватарка">
            @else
                <img id="avatar-preview" src="{{ asset('images/default-avatar.png') }}" alt="Аватарка">
            @endif
           
        </div>
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

    <script src="{{ asset('js/profile.js') }}"></script>

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