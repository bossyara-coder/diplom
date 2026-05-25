document.addEventListener('DOMContentLoaded', function() {
    // ========== Глобальный поиск, фильтрация и сортировка ==========
    const filterButtons = document.querySelectorAll('.filter-button');
    const sortButtons = document.querySelectorAll('.price-sort');
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const productsContainer = document.querySelector('.products');
    
    // === ЛОГИКА ДЛЯ ВСЕХ СТРАНИЦ КРОМЕ КАТАЛОГА ===
    if (!productsContainer) { 
        if (searchInput && searchButton) {
            // Функция отправки пользователя на страницу каталога с параметром query
            const redirectToCatalog = () => {
                const query = searchInput.value.trim();
                if (query) {
                    // Перенаправляем на /catalog?search=текст_запроса
                    window.location.href = '/catalog?search=' + encodeURIComponent(query);
                } else {
                    // Если поле пустое, просто открываем каталог
                    window.location.href = '/catalog';
                }
            };

            // Клик по кнопку "Поиск"
            searchButton.addEventListener('click', redirectToCatalog);

            // Нажатие клавиши Enter в поле ввода
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    redirectToCatalog();
                }
            });
        }
        return; // Прерываем выполнение скрипта каталога, так как мы на другой странице
    }

    // === ЛОГИКА ИСКЛЮЧИТЕЛЬНО ДЛЯ СТРАНИЦЫ КАТАЛОГА ===
    const originalTitles = new Map();
    document.querySelectorAll('.product-item .pr-title').forEach(titleEl => {
        originalTitles.set(titleEl.closest('.product-item'), titleEl.textContent);
    });

    let allProducts = Array.from(document.querySelectorAll('.product-item'));
    let currentFilter = 'all';
    let currentSort = null;
    let currentSearch = '';

    const normalizeSearchTerm = (term) => {
        return term.toLowerCase()
                  .replace(/футболки/g, 'футболка')
                  .replace(/кроссовки/g, 'кроссовок')
                  .replace(/кеды/g, 'кед')
                  .trim()
                  .replace(/\s+/g, ' ');
    };

    function updateProducts() {
        let filteredProducts = allProducts.filter(product => {
            // Проверка по категории
            if (currentFilter !== 'all' && product.dataset.category !== currentFilter) {
                return false;
            }
            
            // Проверка по поисковому запросу
            if (currentSearch) {
                const title = normalizeSearchTerm(product.querySelector('.pr-title').textContent);
                const price = product.querySelector('.pr-price').textContent.toLowerCase();
                const category = product.dataset.category.toLowerCase();
                
                // Считываем скрытый артикул из data-атрибута карточки
                const article = product.dataset.article ? product.dataset.article.toLowerCase() : '';
                
                const normalizedSearch = normalizeSearchTerm(currentSearch);
                
                const matches = title.includes(normalizedSearch) || 
                              price.includes(normalizedSearch) || 
                              category.includes(normalizedSearch) ||
                              article.includes(normalizedSearch);
                
                if (!matches) return false;
            }
            
            return true;
        });

        // Сортировка по цене
        if (currentSort) {
            filteredProducts.sort((a, b) => {
                const priceA = parseFloat(a.dataset.price);
                const priceB = parseFloat(b.dataset.price);
                return currentSort === 'asc' ? priceA - priceB : priceB - priceA;
            });
        }

        // Отрисовка товаров
        productsContainer.innerHTML = '';
        filteredProducts.forEach(product => {
            const titleElement = product.querySelector('.pr-title');
            
            if (originalTitles.has(product)) {
                titleElement.textContent = originalTitles.get(product);
            }
            
            if (currentSearch) {
                const originalText = originalTitles.get(product) || titleElement.textContent;
                const normalizedSearch = normalizeSearchTerm(currentSearch);
                
                titleElement.innerHTML = originalText.replace(
                    new RegExp(`(${normalizedSearch})`, 'gi'),
                    '<span style="background-color: #fc3abc;">$1</span>'
                );
            }
            
            productsContainer.appendChild(product);
        });

        // Сообщение "Товары не найдены"
        const noResultsMsg = document.getElementById('no-results-message');
        if (filteredProducts.length === 0 && (currentFilter !== 'all' || currentSearch)) {
            if (!noResultsMsg) {
                const msg = document.createElement('p');
                msg.id = 'no-results-message';
                msg.textContent = 'Товары не найдены';
                msg.style.color = '#14151b';
                msg.style.marginTop = '20px';
                msg.style.textAlign = 'center';
                msg.style.width = '100%'; 
                msg.style.fontSize ='1.4rem';
                productsContainer.after(msg);
            }
        } else if (noResultsMsg) {
            noResultsMsg.remove();
        }
    }

    // Обработчики кнопок фильтров
    if (filterButtons.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                currentFilter = this.dataset.filter;
                updateProducts();
            });
        });
    }

    // Обработчики кнопок сортировки
    if (sortButtons.length > 0) {
        sortButtons.forEach(button => {
            button.addEventListener('click', function() {
                sortButtons.forEach(btn => btn.classList.remove('active'));
                
                if (currentSort === this.dataset.sort) {
                    currentSort = null;
                    this.classList.remove('active');
                } else {
                    currentSort = this.dataset.sort;
                    this.classList.add('active');
                }
                
                updateProducts();
            });
        });
    }

    // Обработчики поисковой строки в самом каталоге
    if (searchInput && searchButton) {
        let searchTimer;
        
        // Живой поиск при вводе текста
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                currentSearch = this.value;
                updateProducts();
            }, 300);
        });

        // Кнопка очистить (в каталоге)
        searchButton.addEventListener('click', function() {
            searchInput.value = '';
            currentSearch = '';
            updateProducts();
            searchInput.focus();
        });

        // Очистка по Esc
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Escape') {
                this.value = '';
                currentSearch = '';
                updateProducts();
            }
        });
    }

    // === ПОДХВАТ ПАРАМЕТРА ИЗ URL ПРИ ЗАГРУЗКЕ КАТАЛОГА ===
    const urlParams = new URLSearchParams(window.location.search);
    const urlSearch = urlParams.get('search');
    
    if (urlSearch && searchInput) {
        searchInput.value = urlSearch; // Вставляем текст в инпут каталога
        currentSearch = urlSearch;     // Передаем в переменную поиска
    }

    // Запускаем первичный вывод/фильтрацию товаров
    updateProducts(); 
});