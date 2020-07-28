const btnMenuBars = document.querySelector('#btn-menu-principal');
const btnCloseMenu = document.querySelector('.menu_close');
const menuHamburguer = document.querySelector('.content-menu');

const  activeMenu = () => {
    menuHamburguer.classList.toggle('active');
}

btnMenuBars.addEventListener('click', () => {
    activeMenu();
})

btnCloseMenu.addEventListener('click', () => {
    activeMenu();
})

