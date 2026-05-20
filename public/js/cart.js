document.addEventListener('DOMContentLoaded', function() {
    // ========== Pop-up корзина и глобальная логика ==========
    const cartPopup = document.getElementById('cartPopup');
    const cartOverlay = document.getElementById('cartOverlay');
    // Поддержка как попап корзины, так и отдельной страницы корзины (если она есть)
    const cartItemsContainer = document.getElementById('cartItems') || document.getElementById('cart-items');
    const cartTotal = document.getElementById('cartTotal') || document.getElementById('total-price');
    const cartCountBadge = document.querySelector('.cart-count-badge');
    const closeCartBtn = document.querySelector('.close-cart');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const continueShoppingBtn = document.getElementById('continueShopping');
    const cartButtons = document.querySelectorAll('[data-cart]');
    const cartIcon = document.querySelector('.cart-icon-wrapper');
    
    // Функция для загрузки данных (приоритет у Laravel Session)
    function loadInitialCart() {
        const cartDataElement = document.getElementById('laravel-cart-data');
        let serverCart = [];

        if (cartDataElement && cartDataElement.getAttribute('data-cart')) {
            try {
                const sessionData = JSON.parse(cartDataElement.getAttribute('data-cart'));
                // Превращаем объект в массив
                serverCart = Object.keys(sessionData).map(id => ({
                    id: parseInt(id),
                    name: sessionData[id].name,
                    price: sessionData[id].price,
                    image: sessionData[id].image,
                    quantity: sessionData[id].quantity
                }));
            } catch (e) {
                console.error("Ошибка парсинга данных сервера", e);
            }
        }

        // Если сервер прислал не пустую корзину — это приоритет
        if (serverCart.length > 0) {
            localStorage.setItem('cart', JSON.stringify(serverCart));
            return serverCart;
        }

        // Если сервер пуст, берем из локальной памяти
        return JSON.parse(localStorage.getItem('cart')) || [];
    }

    let cart = loadInitialCart();
    
    // Первичная отрисовка
    updateCart();
    
    if (cartIcon) {
        cartIcon.addEventListener('click', openCart);
    }
    
    // Обработка кликов по кнопкам "Добавить в корзину" в каталоге
    if (cartButtons.length > 0) {
        cartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productItem = this.closest('.product-item');
                const id = productItem.getAttribute('data-id');
                const name = productItem.querySelector('.pr-title').textContent;
                const price = parseInt(productItem.getAttribute('data-price'));
                const imgSrc = productItem.querySelector('img').src;
                
                this.classList.add('added-to-cart');
                setTimeout(() => {
                    this.classList.remove('added-to-cart');
                }, 500);
                
                addToCart(id, name, price, imgSrc);
                openCart();
            });
        });
    }
    
    function addToCart(id, name, price, image) {
        // 1. Обновляем локальный массив
        const existingItem = cart.find(item => item.id == id); // Используем нестрогое равенство на случай если id строка
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({ id, name, price, image, quantity: 1 });
        }

        // 2. Отправляем данные в Laravel Session через fetch
        if (window.Laravel && window.Laravel.cartAddUrl) {
            fetch(window.Laravel.cartAddUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": window.Laravel.csrfToken
                },
                body: JSON.stringify({
                    id: id,
                    name: name,
                    price: price,
                    image: image
                })
            })
            .catch(error => console.error('Ошибка синхронизации с сервером:', error));
        }

        // 3. Обновляем интерфейс и localStorage
        updateCart();
        saveCartToLocalStorage();
    }
    
    function updateCart() {
        if (cartItemsContainer) renderCartItems();
        if (cartTotal) updateCartTotal();
        if (cartCountBadge) updateCartCount();
    }
    
    function renderCartItems() {
        cartItemsContainer.innerHTML = '';
        
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<div class="empty-cart-message">Ваша корзина пуста</div>';
            return;
        }
        
        cart.forEach(item => {
            const cartItemElement = document.createElement('div');
            cartItemElement.className = 'cart-item';
            
            cartItemElement.innerHTML = `
                <img class="cart-item-img" src="${item.image}" alt="${item.name}">
                <div class="cart-item-info">
                    <h3 class="cart-item-title">${item.name}</h3>
                    <p class="cart-item-price">${item.price} руб. × ${item.quantity} = ${item.price * item.quantity} руб.</p>
                    <div class="cart-item-controls">
                        <button class="quantity-btn decrease-item" data-id="${item.id}">-</button>
                        <span class="cart-item-quantity">${item.quantity}</span>
                        <button class="quantity-btn increase-item" data-id="${item.id}">+</button>
                        <button class="remove-item" data-id="${item.id}">Удалить</button>
                    </div>
                </div>
            `;
            
            cartItemsContainer.appendChild(cartItemElement);
        });
        
          // Обработчик ПЛЮСИКА
          document.querySelectorAll('.increase-item').forEach(button => {
              button.addEventListener('click', function() {
                  const id = this.getAttribute('data-id');
                  const item = cart.find(item => item.id == id);
                  if (item) {
                      // 1. Меняем локально
                      item.quantity += 1;

                      // 2. Сообщаем серверу
                      syncQuantityWithServer(id, 'increase');

                      // 3. Обновляем экран
                      updateCart();
                      saveCartToLocalStorage();
                  }
              });
          });

          // Обработчик МИНУСА
          document.querySelectorAll('.decrease-item').forEach(button => {
              button.addEventListener('click', function() {
                  const id = this.getAttribute('data-id');
                  const item = cart.find(item => item.id == id);
                  if (item) {
                      if (item.quantity > 1) {
                          item.quantity -= 1;
                          syncQuantityWithServer(id, 'decrease');
                      } else {
                          // Если был 1 товар и нажали минус — это удаление
                          cart = cart.filter(i => i.id != id);
                          // Тут вызывай функцию удаления, которую мы делали раньше
                          fetch('/cart/remove', {
                              method: "POST",
                              headers: {
                                  "Content-Type": "application/json",
                                  "X-CSRF-TOKEN": window.Laravel.csrfToken
                              },
                              body: JSON.stringify({ id: id })
                          });
                      }
                      updateCart();
                      saveCartToLocalStorage();
                  }
              });
          });

        // Вспомогательная функция для связи с Laravel
        function syncQuantityWithServer(id, action) {
            fetch('/cart/update-quantity', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": window.Laravel.csrfToken
                },
                body: JSON.stringify({ id: id, action: action })
            })
            .catch(error => console.error('Ошибка синхронизации количества:', error));
        }
        
        document.querySelectorAll('.remove-item').forEach(button => {
          button.addEventListener('click', function() {
              const id = this.getAttribute('data-id');

              // 1. Удаляем локально (в массиве JS)
              cart = cart.filter(item => item.id != id);

              // 2. Отправляем запрос в Laravel, чтобы удалить из сессии
              fetch('/cart/remove', {
                  method: "POST",
                  headers: {
                      "Content-Type": "application/json",
                      // Используем токен, который у вас уже прописан в window.Laravel
                      "X-CSRF-TOKEN": window.Laravel.csrfToken 
                  },
                  body: JSON.stringify({ id: id })
              })
              .then(response => response.json())
              .then(data => console.log('Удалено с сервера:', data))
              .catch(error => console.error('Ошибка удаления:', error));
            
              // 3. Обновляем интерфейс
              updateCart();
              saveCartToLocalStorage();
          });
      });
    }
    
    function updateCartTotal() {
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        cartTotal.textContent = total.toLocaleString();
    }
    
    function updateCartCount() {
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCountBadge.textContent = count;
    }
    
    function saveCartToLocalStorage() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }
    
    function openCart() {
        if (cartPopup && cartOverlay) {
            cartPopup.classList.add('show');
            cartOverlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closeCart() {
        if (cartPopup && cartOverlay) {
            cartPopup.classList.remove('show');
            cartOverlay.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
    }
    
    if (closeCartBtn) closeCartBtn.addEventListener('click', closeCart);
    if (continueShoppingBtn) continueShoppingBtn.addEventListener('click', closeCart);
    if (cartOverlay) cartOverlay.addEventListener('click', closeCart);
    
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function() {
            if (cart.length === 0) {
                alert('Корзина пуста!');
                return;
            }

            const authMeta = document.querySelector('meta[name="auth-check"]');
            const isAuth = authMeta ? authMeta.content === 'true' : false;

            if (isAuth) {
                alert(`Заказ оформлен! Сумма: ${cartTotal.textContent} руб.`);
                cart = [];
                updateCart();
                saveCartToLocalStorage();
                closeCart();
            } else {
                alert('Для оформления заказа необходимо зарегистрироваться');
                const registerUrl = this.getAttribute('data-url');
                if (registerUrl) window.location.href = registerUrl; 
            }
        });
    }
});