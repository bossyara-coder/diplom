<!DOCTYPE html>
<html>
<head>
    <title>TRAILBLAZE</title>
    <link rel="stylesheet" href="{{asset('css/style-gg.css')}}">
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

<div class="search-container">
        <input type="text" id="search-input" placeholder="Поиск товаров...">
        <button class="search-button" id="search-button">Поиск</button>
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

  <section class="hero-section">
    <div class="hero-container">
        
        <div class="hero-content">
            <h1 class="hero-title">Готовые скейтборды</h1>
            <p class="hero-description">
                Отличный вариант для первого скейта. Все компоненты идеально собраны. 
                Испытай его уже сегодня!
            </p>
            <a href="{{ route('catalog') }}" class="hero-button">Перейти в каталог</a>
        </div>
        
        <div class="hero-image-wrap">
            <img src="{{ asset('image/fon2.jpg') }}" alt="Каталог скейтбордов">
        </div>

    </div>
  </section>

  <section class="products-section">
      <div class="section-header">
          <h2 class="section-title">Хиты продаж</h2>
          <p class="section-subtitle">Свежие комплиты от лучших мировых брендов</p>
      </div>

      <div class="products-grid">

          <div class="product-card">
              <div class="product-slider">
                  <div class="product-slides">
                      <div class="product-slide active">
                          <img src="{{ asset('image/skate/mason1.jpg') }}" alt="Mason On The Rocks 1">
                      </div>
                      <div class="product-slide">
                          <img src="{{ asset('image/skate/mason2.jpg') }}" alt="Mason On The Rocks 2">
                      </div>
                  </div>
                  <button class="slider-btn prev-btn" aria-label="Предыдущий слайд">&#10094;</button>
                  <button class="slider-btn next-btn" aria-label="Следующий слайд">&#10095;</button>
                  <div class="product-indicators">
                      <span class="indicator active" data-slide="0"></span>
                      <span class="indicator" data-slide="1"></span>
                  </div>
              </div>
              <div class="product-info">
                  <h3 class="product-name">Mason On The Rocks Skateboard Complete</h3>
                  <p class="product-price">12 099 ₽</p>
              </div>
          </div>

          <div class="product-card">
              <div class="product-slider">
                  <div class="product-slides">
                      <div class="product-slide active">
                          <img src="{{ asset('image/skate/hello_kit1.jpg') }}" alt="Bannerot Hello Kitty 1">
                      </div>
                      <div class="product-slide">
                          <img src="{{ asset('image/skate/hello_kit2.jpg') }}" alt="Bannerot Hello Kitty 2">
                      </div>
                  </div>
                  <button class="slider-btn prev-btn" aria-label="Предыдущий слайд">&#10094;</button>
                  <button class="slider-btn next-btn" aria-label="Следующий слайд">&#10095;</button>
                  <div class="product-indicators">
                      <span class="indicator active" data-slide="0"></span>
                      <span class="indicator" data-slide="1"></span>
                  </div>
              </div>
              <div class="product-info">
                  <h3 class="product-name">Bannerot Hello Kitty 50 Complete</h3>
                  <p class="product-price">9 090 ₽</p>
              </div>
          </div>

          <div class="product-card">
              <div class="product-slider">
                  <div class="product-slides">
                      <div class="product-slide active">
                          <img src="{{ asset('image/skate/pacman1.jpg') }}" alt="Girl Pac-Man 1">
                      </div>
                      <div class="product-slide">
                          <img src="{{ asset('image/skate/pacman2.jpeg') }}" alt="Girl Pac-Man 2">
                      </div>
                  </div>
                  <button class="slider-btn prev-btn" aria-label="Предыдущий слайд">&#10094;</button>
                  <button class="slider-btn next-btn" aria-label="Следующий слайд">&#10095;</button>
                  <div class="product-indicators">
                      <span class="indicator active" data-slide="0"></span>
                      <span class="indicator" data-slide="1"></span>
                  </div>
              </div>
              <div class="product-info">
                  <h3 class="product-name">Girl Pac-Man Complete</h3>
                  <p class="product-price">8 699 ₽</p>
              </div>
          </div>

          <div class="product-card">
              <div class="product-slider">
                  <div class="product-slides">
                      <div class="product-slide active">
                          <img src="{{ asset('image/skate/fir1.jpg') }}" alt="Flames Mini 1">
                      </div>
                      <div class="product-slide">
                          <img src="{{ asset('image/skate/fir2.jpg') }}" alt="Flames Mini 2">
                      </div>
                  </div>
                  <button class="slider-btn prev-btn" aria-label="Предыдущий слайд">&#10094;</button>
                  <button class="slider-btn next-btn" aria-label="Следующий слайд">&#10095;</button>
                  <div class="product-indicators">
                      <span class="indicator active" data-slide="0"></span>
                      <span class="indicator" data-slide="1"></span>
                  </div>
              </div>
              <div class="product-info">
                  <h3 class="product-name">Flames Mini Skateboard Complete</h3>
                  <p class="product-price">7 270 ₽</p>
              </div>
          </div>

      </div>
  </section>

  <section class="components-section">
        <div class="components-container">

            <div class="comp-image-wrap">
                <img src="{{ asset('image/wolt.jpg') }}" alt="Комплектующие для скейта">
            </div>

            <div class="comp-content">
                <h2 class="comp-title">Комплектующие для скейта</h2>
                <p class="comp-description">
                    Помимо собранных скейтбордов у нас есть и отдельные запчасти для них. 
                    Соберите свой кастомный скейтборд прямо сейчас!
                </p>
                <a href="{{ route('catalog') }}" class="comp-button">В каталог запчастей</a>
            </div>

        </div>
  </section>

  <section class="products-section">
    <div class="section-header">
        <h2 class="section-title">Запчасти и комплектующие</h2>
        <p class="section-subtitle">Проверенные детали для твоего кастома</p>
    </div>

    <div class="products-grid">
        
        <div class="product-card">
            <div class="product-slider">
                <div class="product-slides">
                    <div class="product-slide active"><img src="{{ asset('image/comp/hku1.jpg') }}" alt="Grip 1"></div>
                    <div class="product-slide"><img src="{{ asset('image/comp/hku2.jpg') }}" alt="Grip 2"></div>
                </div>
                <button class="slider-btn prev-btn">&#10094;</button>
                <button class="slider-btn next-btn">&#10095;</button>
                <div class="product-indicators">
                    <span class="indicator active" data-slide="0"></span>
                    <span class="indicator" data-slide="1"></span>
                </div>
            </div>
            <div class="product-info">
                <h3 class="product-name">Шкурка Bear Cutout Regular Grip</h3>
                <p class="product-price">775 ₽</p>
            </div>
        </div>

        <div class="product-card">
            <div class="product-slider">
                <div class="product-slides">
                    <div class="product-slide active">
                        <img src="{{ asset('image/comp/pod.jpg') }}" alt="Trucks">
                    </div>
                </div>
            </div>
            <div class="product-info">
                <h3 class="product-name">Подвески Severed Hollow Lights Thunder</h3>
                <p class="product-price">8 550 ₽</p>
            </div>
        </div>

        <div class="product-card">
            <div class="product-slider">
                <div class="product-slides">
                    <div class="product-slide active"><img src="{{ asset('image/comp/wh1.jpg') }}" alt="Wheels"></div>
                    <div class="product-slide"><img src="{{ asset('image/comp/wh2.jpg') }}" alt="Wheels"></div>
                </div>
                <button class="slider-btn prev-btn">&#10094;</button>
                <button class="slider-btn next-btn">&#10095;</button>
                <div class="product-indicators">
                    <span class="indicator active" data-slide="0"></span>
                    <span class="indicator" data-slide="1"></span>
                </div>
            </div>
            <div class="product-info">
                <h3 class="product-name">Колеса Spitfire 80hd Fade Conical Full</h3>
                <p class="product-price">4 150 ₽</p>
            </div>
        </div>

        <div class="product-card">
            <div class="product-slider">
                <div class="product-slides">
                    <div class="product-slide active">
                        <img src="{{ asset('image/comp/be.jpg') }}" alt="Bearings">
                    </div>
                </div>
            </div>
            <div class="product-info">
                <h3 class="product-name">Подшипники Spaceballs Abec 7 Bearings</h3>
                <p class="product-price">2 050 ₽</p>
            </div>
        </div>

    </div>
  </section>

  <section class="brands-section">
        <div class="section-header">
            <h2 class="section-title">Популярные бренды</h2>
        </div>
    
                @php
                  // Список файлов из папки public/image/brands
                  $brands = [
                      'br1.png',  'br2.webp', 'br3.webp', 'br4.webp', 'br5.webp',
                      'br6.webp', 'br7.webp', 'br8.webp', 'br9.webp', 'br10.webp', 'br11.webp',
                      'br12.webp', 'br13.webp', 'br14.webp', 'br15.webp', 'br16.webp', 'br17.webp',
                      'br18.webp', 'br19.webp', 'br20.webp', 'br21.webp', 'br22.webp', 'br23.webp',
                      'br24.webp', 'br25.webp', 'br26.webp', 'br27.png', 'br28.png', 'br29.webp', 'br30.webp'
                  ];
              @endphp
    
      <div class="brand-ticker-container">
        <div class="brand-ticker-inner">
            <div class="brand-ticker-track">
                @foreach($brands as $brand)
                    <div class="brand-item">
                        <img src="{{ asset('image/brands/' . $brand) }}" alt="Brand">
                    </div>
                @endforeach
            </div>
            <div class="brand-ticker-track" aria-hidden="true">
                @foreach($brands as $brand)
                    <div class="brand-item">
                        <img src="{{ asset('image/brands/' . $brand) }}" alt="Brand">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

  <section class="categories-section">
    <div class="section-header">
        <h2 class="section-title">Категории</h2>
    </div>

    <div class="categories-grid">
        <a href="#" class="category-card">
            <div class="category-img">
                <img src="{{ asset('image/trsh.png') }}" alt="Одежда">
            </div>
            <div class="category-text">
                <p>Одежда</p>
            </div>
        </a>

        <a href="#" class="category-card">
            <div class="category-img">
                <img src="{{ asset('image/conv.png') }}" alt="Обувь">
            </div>
            <div class="category-text">
                <p>Обувь</p>
            </div>
        </a>

        <div class="category-card">
            <div class="category-img">
                <img src="{{ asset('image/tool.png') }}" alt="Аксессуары">
            </div>
            <div class="category-text">
                <p>Аксессуары</p>
            </div>
        </div>
    </div>
  </section>


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

    
  <script src="{{asset('js/home.js')}}"></script>
  <script>
    // Данные Laravel остаются здесь
    window.Laravel = {
        csrfToken: '{{ csrf_token() }}',
        cartAddUrl: '{{ route("cart.add") }}'
    };
  </script>
  <script src="{{ asset('js/catalog.js') }}"></script>
  <script src="{{ asset('js/cart.js') }}"></script>
</body>
</html>
