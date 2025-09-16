(function ($) {
  /* -------------------------------------------------------------------------- */
  /*                                   Tilt.js                                  */
  /* -------------------------------------------------------------------------- */
  $('.js-tilt').tilt({
    glare: true,
    maxGlare: 0.2,
    scale: 1.02,
    axis: 'x',
  });

  const idctaBtn = document.querySelector('#idcta-btn');

  idctaBtn.addEventListener('click', () => {
    const myCard = document.querySelector('.my-card');
    myCard.classList.toggle('header__my-card--open');
    idctaBtn.classList.toggle('idcta--open');
  });
})(jQuery);
