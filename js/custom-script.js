(function () {
  console.log('test');
  const idctaBtn = document.querySelector('#idcta-btn');

  idctaBtn.addEventListener('click', () => {
    const myCard = document.querySelector('.my-card');
    myCard.classList.toggle('header__my-card--open');
    idctaBtn.classList.toggle('idcta--open');
  });
})();
