// resources/js/app.js

// 1) Carga la inicialización por defecto de Breeze/Bootstrap
import 'bootstrap';

// 3) Three.js y GLTFLoader para el loader 3D
import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

// 4) Función helper para inicializar el canvas 3D
window.initPizzaLoader = (canvasId, modelUrl) => {
  const canvas   = document.getElementById(canvasId);
  const renderer = new THREE.WebGLRenderer({ canvas, alpha: true });
  renderer.setSize(300, 300);
  const scene    = new THREE.Scene();
  const camera   = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);
  camera.position.z = 2;

  new GLTFLoader().load(modelUrl, gltf => {
    scene.add(gltf.scene);
    (function animate() {
      requestAnimationFrame(animate);
      gltf.scene.rotation.y += 0.01;
      renderer.render(scene, camera);
    })();
  });
};
