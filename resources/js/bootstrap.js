import './init-alpine';

// Importar los renders para 3D
import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

// Exponer una función global para inicializar el loader
window.initPizzaLoader = function(canvasId, modelUrl) {
  const canvas   = document.getElementById(canvasId);
  const renderer = new THREE.WebGLRenderer({ canvas, alpha: true });
  renderer.setSize(300,300);
  const scene    = new THREE.Scene();
  const camera   = new THREE.PerspectiveCamera(75,1,0.1,1000);
  camera.position.z = 2;

  new GLTFLoader().load(modelUrl, gltf => {
    scene.add(gltf.scene);
    (function animate() {
      requestAnimationFrame(animate);
      gltf.scene.rotation.y += 0.01;
      renderer.render(scene,camera);
    })();
  });
};


import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
