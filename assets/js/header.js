const userphoto = document.getElementById('userphoto');
const menu = document.querySelector('.menu-toggle');
const menuItems = document.querySelectorAll('.nav-links li');

menu.addEventListener('click', function (e) {
    e.preventDefault();
    menu.classList.toggle('menu-open');
});