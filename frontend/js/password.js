const button = document.getElementById('show_hide_password');
const image = button.querySelector('img');
const inputType = button.parentNode.querySelector('input');
const tooltipText = button.querySelector('div');

button.addEventListener('click', function () {
  if (image.getAttribute('src') === 'imgs/logos/password_hidden.png') {
    image.setAttribute('src', 'imgs/logos/password_shown.png');
    image.setAttribute('alt', tooltip.hide_pasword);
    inputType.setAttribute('type', 'text');
    tooltipText.innerHTML = tooltip.hide_pasword;
  } else {
    image.setAttribute('src', 'imgs/logos/password_hidden.png');
    image.setAttribute('alt', tooltip.show_pasword);
    inputType.setAttribute('type', 'password');
    tooltipText.innerHTML = tooltip.show_pasword;
  }
});