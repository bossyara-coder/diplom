<!DOCTYPE html>
<html>
<head>
    <title>TRAILBLAZE</title>
    <link rel="stylesheet" href="{{asset('css/style-gg.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body >

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



        <div class="nav-buttons">
          <a href="{{ route('catalog') }}">
            <img src="{{asset('image/korzina.svg')}}" alt="корзина">
          </a>
          <a href="{{ route('profl') }}"> 
            <img src="{{asset('image/user.svg')}}" alt="Профиль">
          </a>
        </div>
    </header>


    <div class="container-main-block">
      <div class="block">
          <div class="image-container">
            <img src="{{asset('image/fon2.jpg')}}" alt="">
          </div>
          <div class="block-text"></div>
            <div class="container-text">
              <div class="text-ready">
                <h1>Готовые скейтборды</h1>
                <p>Отличный вариант для первого скейта. Все компоненты идеально собраны. Испытай его уже сегодня!</p>
              </div>
              <button type="button" class="button-katalog">
                  <a href="{{ route('catalog') }}">Перейти в каталог</a>
              </button>
          </div>
        
      </div>
    </div>

    <div class="container-ready-skate ">
        <div class="block-sk">
            <div class="slider3">
                <div class="slides3">
                  <div class="slide3 active3">
                    <img src="{{asset('image/skate/mason1.jpg')}}" alt="Image 1">
                  </div>
                  <div class="slide3">
                    <img src="{{asset('image/skate/mason2.jpg')}}" alt="Image 2">
                  </div>
                </div>
                <div class="indicators3">
                  <span class="indicator3 active3" data-slide="0"></span>
                  <span class="indicator3" data-slide="1"></span>
                </div>
            </div>
            <div class="text-complete">
              <h1>Mason On The Rocks Skateboard Complete</h1>
              <p>12 099 ₽</p>
            </div>
        </div>
        
        <div class="block-sk">
            <div class="slider3">
                <div class="slides3">
                    <div class="slide3 active3">
                        <img src="{{asset('image/skate/hello_kit1.jpg')}}" alt="Image 1">
                    </div>
                    <div class="slide3">
                        <img src="{{asset('image/skate/hello_kit2.jpg')}}" alt="Image 2">
                    </div>
                </div>
                <div class="indicators3">
                    <span class="indicator3 active3" data-slide="0"></span>
                    <span class="indicator3" data-slide="1"></span>
                </div>
            </div>
          <div class="text-complete">
            <h1>Bannerot Hello Kitty 50 Complete</h1>
            <p>9 090 ₽</p>
          </div>
        </div>

        <div class="block-sk">
        <div class="slider3">
                <div class="slides3">
                    <div class="slide3 active3">
                        <img src="{{asset('image/skate/pacman1.jpg')}}" alt="Image 1">
                    </div>
                    <div class="slide3">
                        <img src="{{asset('image/skate/pacman2.jpeg')}}" alt="Image 2">
                    </div>
                </div>
                <div class="indicators3">
                    <span class="indicator3 active3" data-slide="0"></span>
                    <span class="indicator3" data-slide="1"></span>
                </div>
            </div>
          <div class="text-complete">
            <h1>Girl Pac-Man Complete</h1>
            <p>8 699 ₽</p>
          </div>
        </div>

        <div class="block-sk">
        <div class="slider3">
                <div class="slides3">
                    <div class="slide3 active3">
                        <img src="{{asset('image/skate/fir1.jpg')}}" alt="Image 1">
                    </div>
                    <div class="slide3">
                        <img src="{{asset('image/skate/fir2.jpg')}}" alt="Image 2">
                    </div>
                </div>
                <div class="indicators3">
                    <span class="indicator3 active3" data-slide="0"></span>
                    <span class="indicator3" data-slide="1"></span>
                </div>
            </div>
          <div class="text-complete">
            <h1>Flames Mini Skateboard Complete</h1>
            <p>7 270 ₽</p>
          </div>
        </div>
    </div>


    <div class="container-component">
        <div class="block-component">
        <div class="image-container2">
            <img src="{{asset('image/wolt.jpg')}}" alt="">
          </div>
          <div class="block-text2"></div>
            <div class="container-text2">
              <div class="text-ready">
                <h1>Комплектующие для скейта</h1>
                <p>Помимо собраных скейтбордов у нас есть и отдельные запчасти для него. Соберите свой скейтборд прямо сейчас!</p>
              </div>
              <button type="button" class="button-katalog">
                  <a href="{{ route('catalog') }}">Перейти в каталог</a>
              </button>
          </div>
        </div>
    </div>

    <div class="container-component-skate ">
        <div class="block-sk">
            <div class="slider3">
                <div class="slides3">
                  <div class="slide3 active3">
                    <img src="{{asset('image/comp/hku1.jpg')}}" alt="Image 1">
                  </div>
                  <div class="slide3">
                    <img src="{{asset('image/comp/hku2.jpg')}}" alt="Image 2">
                  </div>
                </div>
                <div class="indicators3">
                  <span class="indicator3 active3" data-slide="0"></span>
                  <span class="indicator3" data-slide="1"></span>
                </div>
            </div>
            <div class="text-complete">
              <h1>Шкурка Bear Cutout Regular Grip</h1>
              <p>775 ₽</p>
            </div>
        </div>
        
        <div class="block-sk">
            <div class="podve">
            <img src="{{asset('image/comp/pod.jpg')}}" alt="Image 1">
            </div>
                
          <div class="text-complete podves">
            <h1>Подвески Severed Hollow Lights Thunder</h1>
            <p>8 550 ₽</p>
          </div>
        </div>

        <div class="block-sk">
        <div class="slider3">
                <div class="slides3">
                    <div class="slide3 active3">
                        <img src="{{asset('image/comp/wh1.jpg')}}" alt="Image 1">
                    </div>
                    <div class="slide3">
                        <img src="{{asset('image/comp/wh2.jpg')}}" alt="Image 2">
                    </div>
                </div>
                <div class="indicators3">
                    <span class="indicator3 active3" data-slide="0"></span>
                    <span class="indicator3" data-slide="1"></span>
                </div>
            </div>
          <div class="text-complete">
            <h1>Колеса Spitfire 80hd Fade Conical Full Skateboard</h1>
            <p>4 150 ₽</p>
          </div>
        </div>

        <div class="block-sk">
            <div class="podve">
            <img src="{{asset('image/comp/be.jpg')}}" alt="Image 1">
            </div>
                
          <div class="text-complete podves">
            <h1>Подшипники Spaceballs Abec 7 Bearings</h1>
            <p>2 050 ₽</p>
          </div>
        </div>
    </div>


    <h1 class="text-kategori">Популярные бренды</h1>
        <div class="brands-slider">
          <div class="slider-container">
              <div class="slider-track">
                  <!-- Логотипы -->
                  <div class="slide"><img src="{{asset('image/br1.png')}}" alt="Brand 1"></div>
                  <div class="slide"><img src="{{asset('image/br2.webp')}}" alt="Brand 2"></div>
                  <div class="slide"><img src="{{asset('image/br3.webp')}}" alt="Brand 3"></div>
                  <div class="slide"><img src="{{asset('image/br4.webp')}}" alt="Brand 4"></div>
                  <div class="slide"><img src="{{asset('image/br5.webp')}}" alt="Brand 5"></div>
                  <div class="slide"><img src="{{asset('image/dc.png')}}" alt="Brand 6"></div>
                  <div class="slide"><img src="{{asset('image/br7.webp')}}" alt="Brand 7"></div>
                  <div class="slide"><img src="{{asset('image/br8.webp')}}" alt="Brand 8"></div>
                  <div class="slide"><img src="{{asset('image/br9.webp')}}" alt="Brand 9"></div>
                  <div class="slide"><img src="{{asset('image/br10.webp')}}" alt="Brand 10"></div>
                  <div class="slide"><img src="{{asset('image/br11.webp')}}" alt="Brand 11"></div>
                  <div class="slide"><img src="{{asset('image/br12.webp')}}" alt="Brand 12"></div>
                  <div class="slide"><img src="{{asset('image/br13.webp')}}" alt="Brand 13"></div>
                  <div class="slide"><img src="{{asset('image/br14.webp')}}" alt="Brand 14"></div>
                  <div class="slide"><img src="{{asset('image/br15.webp')}}" alt="Brand 15"></div>
                  <div class="slide"><img src="{{asset('image/br16.webp')}}" alt="Brand 16"></div>
                  <div class="slide"><img src="{{asset('image/br17.webp')}}" alt="Brand 17"></div>
                  <div class="slide"><img src="{{asset('image/br18.webp')}}" alt="Brand 18"></div>
                  <div class="slide"><img src="{{asset('image/br19.webp')}}" alt="Brand 19"></div>
                  <div class="slide"><img src="{{asset('image/br20.webp')}}" alt="Brand 20"></div>
                  <div class="slide"><img src="{{asset('image/br21.webp')}}" alt="Brand 21"></div>
                  <div class="slide"><img src="{{asset('image/br22.webp')}}" alt="Brand 12"></div>
                  <div class="slide"><img src="{{asset('image/br23.webp')}}" alt="Brand 12"></div>
                  <div class="slide"><img src="{{asset('image/br24.webp')}}" alt="Brand 12"></div>
                  <div class="slide"><img src="{{asset('image/br25.webp')}}" alt="Brand 12"></div>
                  <div class="slide"><img src="{{asset('image/br26.webp')}}" alt="Brand 12"></div>
                  <div class="slide"><img src="{{asset('image/br27.png')}}" alt="Brand 12"></div>
                  <div class="slide"><img src="{{asset('image/br28.png')}}" alt="Brand 12"></div>
                  <div class="slide"><img src="{{asset('image/br29.webp')}}" alt="Brand 12"></div>
                  <div class="slide"><img src="{{asset('image/br30.webp')}}" alt="Brand 12"></div>
              </div>
          </div>
    <!-- Стрелки навигации -->
    <button class="prev">&#10094;</button>
    <button class="next">&#10095;</button>
</div>


    <h1 class="text-kategori">Категории</h1>
    <div class="container-kategori">
        <div class="block-kategor">
          <div class="clothes-img kategoriim">
            <img src="{{asset('image/trsh.png')}}" alt="">
          </div>
          <div class="clothes text">
              <p>Большой выбор одежды на любой вкус</p>
          </div>
        </div>

        <div class="block-kategor">
          <div class="clothes-img kategoriim">
            <img src="{{asset('image/conv.png')}}" alt="">
          </div>
          <div class="clothes text">
            <p>Разнообразие в ассортименте обуви</p>
          </div>
        </div>

        <div class="block-kategor">
          <div class="clothes-img kategoriim">
            <img src="{{asset('image/tool.png')}}" alt="">
          </div>
          <div class="clothes text">
            <p>Акссесуары для вас</p>
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
</body>
</html>
