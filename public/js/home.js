document.addEventListener('DOMContentLoaded', function () {
    
    // ==========================================================================
    // 1. ЛОГИКА СЛАЙДЕРА ВНУТРИ КАРТОЧЕК ТОВАРОВ
    // ==========================================================================
    const cards = document.querySelectorAll('.product-card');

    cards.forEach(card => {
        const slides = card.querySelectorAll('.product-slide');
        const indicators = card.querySelectorAll('.indicator');
        const prevBtn = card.querySelector('.prev-btn');
        const nextBtn = card.querySelector('.next-btn');

        if (!prevBtn || !nextBtn) return;

        const updateSlider = (index) => {
            slides.forEach((s, i) => s.classList.toggle('active', i === index));
            indicators.forEach((ind, i) => ind.classList.toggle('active', i === index));
        };

        nextBtn.addEventListener('click', () => {
            let activeIndex = Array.from(slides).findIndex(s => s.classList.contains('active'));
            updateSlider((activeIndex + 1) % slides.length);
        });

        prevBtn.addEventListener('click', () => {
            let activeIndex = Array.from(slides).findIndex(s => s.classList.contains('active'));
            updateSlider((activeIndex - 1 + slides.length) % slides.length);
        });

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => updateSlider(index));
        });
    });


    // ==========================================================================
    // 2. ИСПРАВЛЕННАЯ ЛОГИКА ПЕРЕТАСКИВАНИЯ И АВТОПРОКРУТКИ БРЕНДОВ (ЧЕРЕЗ JS)
    // ==========================================================================
    const tickerContainer = document.querySelector('.brand-ticker-container');
    const tickerInner = document.querySelector('.brand-ticker-inner');

    if (tickerContainer && tickerInner) {
        let isDown = false;
        let isHovered = false;
        let startX;
        let translateX = 0;
        let speed = 0.8; // Скорость автопрокрутки (чем меньше, тем плавнее)

        // Главный цикл анимации (requestAnimationFrame вместо setInterval/CSS)
        function animate() {
            // Двигаем только если мышка НЕ зажата и НЕ наведена на контейнер
            if (!isDown && !isHovered) {
                translateX -= speed;
                
                // Вычисляем ширину одного набора брендов
                const halfWidth = tickerInner.scrollWidth / 2;
                
                // Если прокрутили первый набор целиком, бесшовно сбрасываем позицию на 0
                if (Math.abs(translateX) >= halfWidth) {
                    translateX = 0;
                }
                
                tickerInner.style.transform = `translateX(${translateX}px)`;
            }
            requestAnimationFrame(animate);
        }

        // Запуск анимации
        requestAnimationFrame(animate);

        // События мыши для остановки при наведении
        tickerContainer.addEventListener('mouseenter', () => {
            isHovered = true;
        });

        tickerContainer.addEventListener('mouseleave', () => {
            isHovered = false;
            if (isDown) {
                isDown = false;
                tickerContainer.classList.remove('grabbing');
            }
        });

        // Зажатие мышки (Начало Drag)
        tickerContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            tickerContainer.classList.add('grabbing');
            startX = e.pageX - translateX;
        });

        // Отпустили мышку (Конец Drag)
        tickerContainer.addEventListener('mouseup', () => {
            if (!isDown) return;
            isDown = false;
            tickerContainer.classList.remove('grabbing');

            // Корректируем позицию после перетаскивания, чтобы избежать пустых зон
            const halfWidth = tickerInner.scrollWidth / 2;
            if (translateX > 0) {
                translateX -= halfWidth;
            } else if (Math.abs(translateX) >= halfWidth) {
                translateX += halfWidth;
            }
        });

        // Движение мыши (Перетаскивание)
        tickerContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault(); // Запрещаем выделение картинок блоком
            
            // Вычисляем новую позицию на основе движения курсора
            translateX = e.pageX - startX;
            tickerInner.style.transform = `translateX(${translateX}px)`;
        });
    }
});