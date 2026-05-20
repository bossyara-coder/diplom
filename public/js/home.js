document.addEventListener('DOMContentLoaded', function () {
    const sliderTrack = document.querySelector('.slider-track');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    const slides = document.querySelectorAll('.slide');
    const slideWidth = slides[0].clientWidth; // Ширина одного слайда
    let currentIndex = 2; // Начинаем с первого основного слайда (после дубликатов)

    // Функция для перехода к следующему слайду
    function nextSlide() {
        currentIndex++;
        if (currentIndex >= slides.length - 2) {
            // Если дошли до конца, мгновенно переходим к началу
            sliderTrack.style.transition = 'none';
            sliderTrack.style.transform = `translateX(${-2 * slideWidth}px)`;
            currentIndex = 2; // Возвращаемся к первому основному слайду
            setTimeout(() => {
                sliderTrack.style.transition = 'transform 0.5s ease-in-out';
                nextSlide();
            }, 0);
        } else {
            sliderTrack.style.transform = `translateX(${-currentIndex * slideWidth}px)`;
        }
    }

    // Функция для перехода к предыдущему слайду
    function prevSlide() {
        currentIndex--;
        if (currentIndex < 0) {
            // Если дошли до начала, мгновенно переходим к концу
            sliderTrack.style.transition = 'none';
            sliderTrack.style.transform = `translateX(${-(slides.length - 3) * slideWidth}px)`;
            currentIndex = slides.length - 3; // Возвращаемся к последнему основному слайду
            setTimeout(() => {
                sliderTrack.style.transition = 'transform 0.5s ease-in-out';
                prevSlide();
            }, 0);
        } else {
            sliderTrack.style.transform = `translateX(${-currentIndex * slideWidth}px)`;
        }
    }

    // Автоматическая прокрутка
    let autoSlide = setInterval(nextSlide, 3000);

    // Остановка автоматической прокрутки при наведении
    sliderTrack.addEventListener('mouseenter', () => clearInterval(autoSlide));
    sliderTrack.addEventListener('mouseleave', () => autoSlide = setInterval(nextSlide, 3000));

    // Навигация с помощью кнопок
    nextButton.addEventListener('click', nextSlide);
    prevButton.addEventListener('click', prevSlide);
});





document.addEventListener('DOMContentLoaded', function () {
    // Находим все слайдеры на странице с классом .slider3
    const sliders3 = document.querySelectorAll('.slider3');
  
    sliders3.forEach((slider3) => {
      const slides3 = slider3.querySelector('.slides3');
      const indicators3 = slider3.querySelectorAll('.indicator3');
      const totalSlides3 = slider3.querySelectorAll('.slide3').length;
      let currentIndex3 = 0;
  
      function showSlide3(index3) {
        // Корректировка индекса для цикличности
        if (index3 < 0) {
          index3 = totalSlides3 - 1;
        } else if (index3 >= totalSlides3) {
          index3 = 0;
        }
  
        const offset3 = -index3 * 100;
        slides3.style.transform = `translateX(${offset3}%)`;
  
        // Обновление индикаторов
        indicators3.forEach((indicator3, i) => {
          if (i === index3) {
            indicator3.classList.add('active3');
          } else {
            indicator3.classList.remove('active3');
          }
        });
  
        currentIndex3 = index3;
      }
  
      // Переключение по индикаторам
      indicators3.forEach((indicator3, index3) => {
        indicator3.addEventListener('click', () => {
          showSlide3(index3);
        });
      });
  
      // Автоматическое переключение слайдов (опционально)
      setInterval(() => {
        showSlide3(currentIndex3 + 1);
      }, 4000); // Интервал 3 секунды
    });
  });