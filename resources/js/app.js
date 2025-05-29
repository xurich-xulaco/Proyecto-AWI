// resources/js/app.js

// 1) Carga la inicialización por defecto de Breeze/Bootstrap
import 'bootstrap';

// 2) Cargar Adwaita
import 'adwaveui';

const btn = document.getElementById('theme-toggle');
btn?.addEventListener('click', () => {
  const html = document.documentElement;
  html.dataset.theme = html.dataset.theme === 'dark' ? 'light' : 'dark';
});
