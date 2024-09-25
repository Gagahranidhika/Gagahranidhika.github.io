function toggleMode() {
    const body = document.body;
    body.classList.toggle('dark-mode');
    
    const mode = body.classList.contains('dark-mode') ? 'dark' : 'light';
    localStorage.setItem('theme', mode);
}

function loadTheme() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.body.classList.add(savedTheme + '-mode');
        document.getElementById('mode-toggle').checked = savedTheme === 'dark';
    }
}

function toggleMenu() {
    const menu = document.querySelector('nav ul.menu');
    const overlay = document.querySelector('.menu-overlay');
    
    menu.classList.toggle('show');
    overlay.style.display = menu.classList.contains('show') ? 'block' : 'none';

    const hamburger = document.querySelector('.hamburger-icon');
    const expanded = menu.classList.contains('show');
    hamburger.setAttribute('aria-expanded', expanded);
}

function closeMenu() {
    const menu = document.querySelector('nav ul.menu');
    const overlay = document.querySelector('.menu-overlay');
    if (menu.classList.contains('show')) {
        menu.classList.remove('show');
        overlay.style.display = 'none';
    }
}


window.onload = loadTheme; 


window.addEventListener('click', function(e) {
    const menu = document.querySelector('nav ul.menu');
    const hamburger = document.querySelector('.hamburger-icon');
    

    if (!hamburger.contains(e.target) && !menu.contains(e.target)) {
        closeMenu();
    }
});

window.onload = function() {
    openPopup();
};

function openPopup() {
    document.getElementById('mangaPopup').classList.add('show');
    document.querySelector('.menu-overlay').classList.add('show');
}

function closePopup() {
    document.getElementById('mangaPopup').classList.remove('show');
    document.querySelector('.menu-overlay').classList.remove('show');
}

