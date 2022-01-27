let menuChanged = 1030;  // !УСТАНАВЛИВАЕТ ШИРИНУ, ПОСЛЕ КОТОРОЙ МЕНЮ МЕНЯЕТ ФОРМУ
let menuTimer;          // !ТАЙМЕР ВОЗВРАТА ВЫСОТЫ МЕНЮ
// drop-menu
document.querySelectorAll('.drop-menu__toggle').forEach(function(item) {
    item.addEventListener('click', function() {
        if (document.documentElement.scrollWidth <= menuChanged) {
            clearTimeout(menuTimer);
            document.querySelector('.menu').style.height = 'auto';
            menuTimer = setTimeout(() => document.querySelector('.menu').style.height = document.querySelector('.menu').scrollHeight + 'px', 500);
        } 
        if (this.parentNode.querySelector('.drop-menu').classList.contains('drop-menu_active')) {
            this.querySelector('.menu__chevron').classList.remove('menu__chevron_rotate');
            this.parentNode.querySelector('.drop-menu').classList.remove('drop-menu_active');
            this.parentNode.querySelector('.drop-menu').style.height = this.parentNode.querySelector('.drop-menu').scrollHeight + 'px';
            this.parentNode.querySelector('.drop-menu').style.height = '0px';
        } else {
            this.querySelector('.menu__chevron').classList.add('menu__chevron_rotate');
            this.parentNode.querySelector('.drop-menu').classList.add('drop-menu_active');
            this.parentNode.querySelector('.drop-menu').style.height = this.parentNode.querySelector('.drop-menu').scrollHeight + 'px';
        }
    })
})
// main menu
document.querySelector('.menu__toggle-btn').addEventListener('click' ,function() {
    let menu = this.parentNode.parentNode.querySelector('.menu');
    if (menu.classList.contains('menu_active')) {
        menu.classList.remove('menu_active');
        menu.style.height = '0px';
    } else {
        menu.classList.add('menu_active');
        menu.style.height = menu.scrollHeight + 'px';
    }
})
document.querySelectorAll('.drop-menu').forEach(function(item) {
    item.style.height = '0px';
})
if (document.documentElement.scrollWidth <= menuChanged) {
    document.querySelector('.menu').style.height = '0px';
}
// main menu and drop-menu when resize
window.addEventListener('resize', function() {
    document.querySelector('.menu').classList.remove('menu_active');
    document.querySelectorAll('.menu__chevron').forEach(item => item.classList.remove('menu__chevron_rotate'));
    document.querySelectorAll('.drop-menu').forEach(function(item) {
        item.style.height = '0px';
        item.classList.remove('drop-menu_active');
    })
    if (document.documentElement.scrollWidth > menuChanged) {
        document.querySelector('.menu').style.height = 'auto';
    } else {
        document.querySelector('.menu').style.height = '0px';
    }
})
// drop-toggle width
// document.querySelectorAll('.drop-menu__wrapper .drop-menu__toggle').forEach(item => {
//     item.style.width = item.parentNode.querySelector('.drop-menu').offsetWidth + 'px';

// }) 