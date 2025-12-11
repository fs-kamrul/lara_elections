/******/ (() => { // webpackBootstrap
/*!*********************************************!*\
  !*** ./Resources/assets/js/event_public.js ***!
  \*********************************************/
document.querySelectorAll('.faq-toggle').forEach(function (button) {
  button.addEventListener('click', function () {
    var content = button.nextElementSibling;
    var icon = button.querySelector('i');
    content.classList.toggle('hidden');
    icon.classList.toggle('ri-arrow-down-s-line');
    icon.classList.toggle('ri-arrow-up-s-line');
  });
});

// Testimonial Slider
var currentSlide = 0;
var slides = document.querySelectorAll('.testimonial-slide');
var track = document.querySelector('.testimonial-track');
var dots = document.querySelectorAll('.testimonial-dot');
var totalSlides = slides.length;
function updateSlider() {
  track.style.transform = "translateX(-".concat(currentSlide * 100, "%)");

  // Update dots
  dots.forEach(function (dot, index) {
    if (index === currentSlide) {
      dot.classList.remove('bg-gray-300');
      dot.classList.add('bg-primary-blue');
    } else {
      dot.classList.remove('bg-primary-blue');
      dot.classList.add('bg-gray-300');
    }
  });
}
document.querySelector('.testimonial-next').addEventListener('click', function () {
  currentSlide = (currentSlide + 1) % totalSlides;
  updateSlider();
});
document.querySelector('.testimonial-prev').addEventListener('click', function () {
  currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
  updateSlider();
});

// Dot navigation
dots.forEach(function (dot, index) {
  dot.addEventListener('click', function () {
    currentSlide = index;
    updateSlider();
  });
});

// Auto-play slider
setInterval(function () {
  currentSlide = (currentSlide + 1) % totalSlides;
  updateSlider();
}, 5000);
/******/ })()
;