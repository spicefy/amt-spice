document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.swiper').forEach(function (el) {
      new Swiper(el, JSON.parse(el.getAttribute('data-swiper-options')));
    });
  });