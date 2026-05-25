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
                    <li>
                        <span>Артикул:</span> 
                        <strong class="copy-article" style="cursor: pointer; text-decoration: underline dotted; color: #14151b;" title="Нажмите, чтобы скопировать">
                            {{ $product->article }}
                        </strong>
                        <span id="copyAlert" style="display: none; margin-left: 10px; color: #fc3e57; font-size: 0.85rem; font-weight: bold;">
                            Скопировано!
                        </span>
                    </li>
                    <li><span>Наличие:</span> <strong>На складе</strong></li>
                </ul>
            </div>


            <button data-cart type="button" class="cart_button buy-button">
                <h5>Добавить в корзину</h5>
            </button>






<div class="product-rating-section">
    <h3>Рейтинг товара</h3>
    
    <div class="rating-summary">
        <div class="average-score">
            <h2>{{ number_format($averageRating, 1) }}</h2>
            <p>Оценок: {{ $ratingsCount }}</p>
        </div>
        
        <div class="rating-breakdown">
            @foreach([5, 4, 3, 2, 1] as $star)
                <div class="breakdown-row">
                    <span class="star-label">{{ $star }} ★</span>
                    <div class="bar-container">
                        @php 
                            $percent = $ratingsCount > 0 ? ($breakdown[$star] / $ratingsCount) * 100 : 0; 
                        @endphp
                        <div class="bar-fill" style="width: {{ $percent }}%;"></div>
                    </div>
                    <span class="count-label">{{ $breakdown[$star] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="user-rating-box">
        @auth
            <p>Оцените этот товар:</p>
            <form action="{{ route('product.rate', $product->id) }}" method="POST" class="rating-form">
                @csrf
                <input type="hidden" name="rating" id="rating-value" value="{{ $userRating }}">
                
                <div class="stars-interactive" id="stars-container">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= $userRating ? 'active' : '' }}" data-value="{{ $i }}">★</span>
                    @endfor
                </div>
                
                <button type="submit" class="btn-submit-rating">Сохранить</button>
            </form>
            @if(session('success'))
                <p style="color: #4CAF50; margin-top: 10px;">{{ session('success') }}</p>
            @endif
        @else
            <p>Чтобы поставить оценку, пожалуйста, <a href="{{ route('login') }}">войдите в аккаунт</a>.</p>
        @endauth
    </div>
</div>














            





        </div>
    </div>
</main>

<div class="product-comments-wrapper">
    <div class="product-comments-section">
    <h3>Обсуждение товара ({{ $product->comments()->count() }})</h3>

    @auth
        <div class="add-comment-box">
            <form action="{{ route('comment.store', $product->id) }}" method="POST">
                @csrf
                <textarea name="content" rows="3" placeholder="Оставьте отзыв или задайте вопрос..." required></textarea>
                <button type="submit" class="btn-submit-comment">Отправить</button>
            </form>
        </div>
    @else
        <p class="login-prompt">Чтобы оставить комментарий, <a href="{{ route('login') }}">войдите в аккаунт</a>.</p>
    @endauth

    <div class="comments-list">
        @foreach($comments as $comment)
            <div class="comment-item">
                <div class="comment-header">
                    <img src="{{ $comment->user->avatar ? asset('storage/avatars/' . $comment->user->avatar) : asset('image/user.svg') }}" alt="Аватар" class="comment-avatar">
                    <div class="comment-meta">
                        <span class="comment-author">{{ $comment->user->name }}</span>
                        <span class="comment-date">{{ $comment->created_at->format('d.m.Y в H:i') }}</span>
                    </div>
                    
                    @auth
                        @if(Auth::id() === $comment->user_id || Auth::user()->role === 'admin')
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" class="delete-comment-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete-comment" onclick="return confirm('Точно удалить?')">Удалить</button>
                            </form>
                        @endif
                    @endauth
                </div>
                
                <p class="comment-text">{{ $comment->content }}</p>
                
                @auth
                    <button class="btn-reply" onclick="toggleReplyForm({{ $comment->id }})">Ответить</button>
                    <div class="reply-form-box" id="reply-form-{{ $comment->id }}" style="display: none;">
                        <form action="{{ route('comment.store', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <textarea name="content" rows="2" placeholder="Ваш ответ..." required></textarea>
                            <button type="submit" class="btn-submit-comment btn-submit-reply">Ответить</button>
                        </form>
                    </div>
                @endauth

                @if($comment->replies->count() > 0)
    <div class="replies-list">
        @foreach($comment->replies as $reply)
            <div class="comment-item reply-item">
                <div class="comment-header">
                    <img src="{{ $reply->user->avatar ? asset('storage/avatars/' . $reply->user->avatar) : asset('image/user.svg') }}" alt="Аватар" class="comment-avatar">
                    <div class="comment-meta">
                        <span class="comment-author">{{ $reply->user->name }}</span>
                        <span class="comment-date">{{ $reply->created_at->format('d.m.Y в H:i') }}</span>
                    </div>

                    @auth
                        @if(Auth::id() === $reply->user_id || Auth::user()->role === 'admin')
                            <form action="{{ route('comment.destroy', $reply->id) }}" method="POST" class="delete-comment-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete-comment" onclick="return confirm('Точно удалить?')">Удалить</button>
                            </form>
                        @endif
                    @endauth
                </div>
                <p class="comment-text">{{ $reply->content }}</p>

                @auth
                    <button class="btn-reply" onclick="toggleReplyForm('reply-to-{{ $reply->id }}')">Ответить</button>
                    
                    <div class="reply-form-box" id="reply-form-reply-to-{{ $reply->id }}" style="display: none; margin-top: 15px;">
                        <form action="{{ route('comment.store', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            
                            <textarea name="content" rows="2" required placeholder="Ваш ответ...">{{ $reply->user->name }}, </textarea>
                            <button type="submit" class="btn-submit-comment btn-submit-reply">Ответить</button>
                        </form>
                    </div>
                @endauth
                </div>
        @endforeach
    </div>
@endif

            </div>
        @endforeach
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
document.addEventListener('DOMContentLoaded', function() {
    const copyTarget = document.querySelector('.copy-article');
    const copyAlert = document.getElementById('copyAlert');

    if (copyTarget && copyAlert) {
        copyTarget.addEventListener('click', function() {
            // Получаем текст артикула (очищаем от лишних пробелов, если они есть)
            const articleText = this.textContent.trim();

            // Используем современный API для записи в буфер обмена
            navigator.clipboard.writeText(articleText).then(() => {
                // Показываем надпись "Скопировано!"
                copyAlert.style.display = 'inline';

                // Спустя 2000 миллисекунд (2 секунды) плавно или мгновенно скрываем её обратно
                setTimeout(() => {
                    copyAlert.style.display = 'none';
                }, 1000);
            }).catch(err => {
                console.error('Не удалось скопировать артикул: ', err);
            });
        });
    }
});
</script>





<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#stars-container .star');
    const ratingInput = document.getElementById('rating-value');

    if (stars.length > 0) {
        stars.forEach(star => {
            // Закрашиваем звезды при наведении мыши
            star.addEventListener('mouseover', function() {
                const value = this.getAttribute('data-value');
                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.add('hover');
                    } else {
                        s.classList.remove('hover');
                    }
                });
            });

            // Убираем закрашивание, когда уводим мышь
            star.addEventListener('mouseout', function() {
                stars.forEach(s => s.classList.remove('hover'));
            });

            // Фиксируем оценку при клике
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                ratingInput.value = value; // Передаем цифру в скрытый input для отправки в базу
                
                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
        });
    }
});
</script>







<script>
    function toggleReplyForm(commentId) {
        const formBox = document.getElementById('reply-form-' + commentId);
        if (formBox.style.display === 'none' || formBox.style.display === '') {
            formBox.style.display = 'block';
        } else {
            formBox.style.display = 'none';
        }
    }
</script>




<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Проверяем, есть ли в памяти сохраненная позиция скролла
    let savedScroll = sessionStorage.getItem('commentScroll');
    if (savedScroll) {
        // Если есть, мгновенно прокручиваем страницу до этого места
        window.scrollTo(0, parseInt(savedScroll));
        // Очищаем память, чтобы при обычном обновлении страницы (F5) скролл не прыгал
        sessionStorage.removeItem('commentScroll'); 
    }

    // 2. Находим все формы внутри блока комментариев (добавление, ответы, удаление)
    const commentForms = document.querySelectorAll('.product-comments-section form');
    
    // 3. Вешаем на каждую форму "прослушку"
    commentForms.forEach(form => {
        form.addEventListener('submit', function() {
            // В момент нажатия кнопки (прямо перед перезагрузкой страницы) 
            // сохраняем текущую позицию экрана во временную память браузера
            sessionStorage.setItem('commentScroll', window.scrollY);
        });
    });
});
</script>






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