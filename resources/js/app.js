import './bootstrap';

window.addEventListener('scroll', function () {
    const header = document.querySelector('.site-header');

    if (!header) return;

    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

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
}
document.querySelectorAll('.site-nav a').forEach(link => {
    link.addEventListener('click', () => {
        nav.classList.remove('active');
        menuToggle.textContent = '☰';
    });
});
const slides = document.querySelectorAll('.past-slide');
const prevSlide = document.getElementById('prevSlide');
const nextSlide = document.getElementById('nextSlide');

let slideIndex = 0;

function showSlide(index) {
    slides.forEach(slide => slide.classList.remove('active'));
    slides[index].classList.add('active');
}

nextSlide.addEventListener('click', function () {
    slideIndex = (slideIndex + 1) % slides.length;
    showSlide(slideIndex);
});

prevSlide.addEventListener('click', function () {
    slideIndex = (slideIndex - 1 + slides.length) % slides.length;
    showSlide(slideIndex);
});
// imagenes cambian automaticamente cada 5 segundos //
function nextSlideAuto() {
    slideIndex = (slideIndex + 1) % slides.length;
    showSlide(slideIndex);
}

setInterval(nextSlideAuto, 5000);