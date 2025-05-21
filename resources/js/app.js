require('./bootstrap');

import { PizzaLoader } from './components/PizzaLoader';

// Initialize the pizza loader when needed
window.initPizzaLoader = function() {
    // Create container if it doesn't exist
    let container = document.getElementById('pizza-loader-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'pizza-loader-container';
        container.style.position = 'fixed';
        container.style.top = '0';
        container.style.left = '0';
        container.style.width = '100%';
        container.style.height = '100%';
        container.style.zIndex = '9999';
        document.body.appendChild(container);
        
        // Add loading text
        const loadingText = document.createElement('div');
        loadingText.className = 'loading-text';
        loadingText.innerHTML = '<h2>Cargando...</h2><p>Preparando su deliciosa experiencia de Pizza Hat</p>';
        loadingText.style.position = 'absolute';
        loadingText.style.top = '50%';
        loadingText.style.left = '50%';
        loadingText.style.transform = 'translate(-50%, -50%)';
        loadingText.style.color = 'white';
        loadingText.style.textAlign = 'center';
        loadingText.style.zIndex = '10000';
        container.appendChild(loadingText);
    }
    
    // Create and show the loader
    window.pizzaLoader = new PizzaLoader(container);
    
    return window.pizzaLoader;
};

// Add loader to window for global access
window.showPizzaLoader = function() {
    if (!window.pizzaLoader) {
        window.initPizzaLoader();
    } else {
        window.pizzaLoader.show();
    }
};

window.hidePizzaLoader = function() {
    if (window.pizzaLoader) {
        window.pizzaLoader.hide();
    }
};

// Show pizza loader on page transitions
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && link.href && link.href.indexOf(window.location.origin) === 0 && !link.dataset.noLoader) {
            window.showPizzaLoader();
        }
    });
});