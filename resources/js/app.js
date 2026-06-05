import './bootstrap';

/* HEADER STICKY */

window.addEventListener('scroll', function () {
    const header = document.querySelector('.site-header');

    if (!header) return;

    if (window.scrollY > 90) {
        header.classList.add('scrolled');
    }

    if (window.scrollY < 40) {
        header.classList.remove('scrolled');
    }
});

/* MENÚ HAMBURGUESA */

const menuToggle = document.getElementById('menuToggle');
const nav = document.querySelector('.site-nav');

if (menuToggle && nav) {
    menuToggle.addEventListener('click', function () {
        nav.classList.toggle('active');

        if (nav.classList.contains('active')) {
            menuToggle.textContent = '✕';
        } else {
            menuToggle.textContent = '☰';
        }
    });

    document.querySelectorAll('.site-nav a').forEach(link => {
        link.addEventListener('click', () => {
            nav.classList.remove('active');
            menuToggle.textContent = '☰';
        });
    });
}

/* CARRUSEL EVENTOS PASADOS */

const slides = document.querySelectorAll('.past-slide');
const indicators = document.querySelectorAll('.indicator');
const prevSlide = document.getElementById('prevSlide');
const nextSlide = document.getElementById('nextSlide');

let slideIndex = 0;

if (slides.length > 0 && prevSlide && nextSlide) {
    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));

        slides[index].classList.add('active');

        if (indicators[index]) {
            indicators[index].classList.add('active');
        }
    }

    nextSlide.addEventListener('click', function () {
        slideIndex = (slideIndex + 1) % slides.length;
        showSlide(slideIndex);
    });

    prevSlide.addEventListener('click', function () {
        slideIndex = (slideIndex - 1 + slides.length) % slides.length;
        showSlide(slideIndex);
    });

    indicators.forEach(indicator => {
        indicator.addEventListener('click', function () {
            slideIndex = Number(this.dataset.slide);
            showSlide(slideIndex);
        });
    });

    setInterval(function () {
        slideIndex = (slideIndex + 1) % slides.length;
        showSlide(slideIndex);
    }, 5000);
}