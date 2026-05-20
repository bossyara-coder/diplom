document.addEventListener('DOMContentLoaded', function() {
    // ========== Каталог: Фильтрация, сортировка и поиск ==========
    const filterButtons = document.querySelectorAll('.filter-button');
    const sortButtons = document.querySelectorAll('.price-sort');
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const productsContainer = document.querySelector('.products');
    
    if (!productsContainer) return; // Прерываем работу скрипта, если мы не на странице каталога

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
            if (currentFilter !== 'all' && product.dataset.category !== currentFilter) {
                return false;
            }
            
            if (currentSearch) {
                const title = normalizeSearchTerm(product.querySelector('.pr-title').textContent);
                const price = product.querySelector('.pr-price').textContent.toLowerCase();
                const category = product.dataset.category.toLowerCase();
                
                const normalizedSearch = normalizeSearchTerm(currentSearch);
                const matches = title.includes(normalizedSearch) || 
                              price.includes(normalizedSearch) || 
                              category.includes(normalizedSearch);
                
                if (!matches) return false;
            }
            
            return true;
        });

        if (currentSort) {
            filteredProducts.sort((a, b) => {
                const priceA = parseFloat(a.dataset.price);
                const priceB = parseFloat(b.dataset.price);
                return currentSort === 'asc' ? priceA - priceB : priceB - priceA;
            });
        }

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

    if (filterButtons.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                currentFilter = this.dataset.filter;
                updateProducts();
            });
        });
        filterButtons[0].classList.add('active');
    }

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

    if (searchInput && searchButton) {
        let searchTimer;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                currentSearch = this.value;
                updateProducts();
            }, 300);
        });

        searchButton.addEventListener('click', function() {
            searchInput.value = '';
            currentSearch = '';
            updateProducts();
            searchInput.focus();
        });

        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Escape') {
                this.value = '';
                currentSearch = '';
                searchButton.style.display = 'none';
                updateProducts();
            }
        });
    }

    updateProducts();
});