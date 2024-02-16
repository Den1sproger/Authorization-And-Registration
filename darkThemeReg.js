const themeButton = document.querySelector('.dark-btn');
const registration = document.querySelector('#registration');
const headerText = document.querySelector('.header-text');


themeButton.addEventListener('click', () => {
  console.log('info');
  registration.classList.toggle('dark-active');
  headerText.classList.toggle('dark-active');
})