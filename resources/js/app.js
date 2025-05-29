// resources/js/app.js

// 1) Carga la inicialización por defecto de Breeze/Bootstrap
import 'bootstrap';

// 2) Cargar Adwaita
import 'adwavecss/dist/styles.min.css';
// 3) Cargar Three.js para el modelo 3D de pizza
import './pizzaLogo.js';

const btn = document.getElementById('theme-toggle');
btn?.addEventListener('click', () => {
  const html = document.documentElement;
  html.dataset.theme = html.dataset.theme === 'dark' ? 'light' : 'dark';
});
