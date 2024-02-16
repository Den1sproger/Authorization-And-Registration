const themeButton = document.querySelector('.dark-btn');
const authorization = document.querySelector('#authorization');
const headerText = document.querySelector('.header-text');
const or = document.querySelector('.or');


themeButton.addEventListener('click', () => {
  authorization.classList.toggle('dark-active');
  headerText.classList.toggle('dark-active');
  or.classList.toggle('dark-active');
})