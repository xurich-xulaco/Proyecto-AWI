// resources/js/pizzaLogo.js
import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

export default function initPizzaLogo(containerId, size) {
  const container = document.getElementById(containerId);
  if (!container) return;

  // Escena, cámara y renderer
  const scene = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(45, size / size, 0.1, 100);
  camera.position.set(0, 0, 3);

  const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
  renderer.setSize(size, size);
  container.appendChild(renderer.domElement);

  // Iluminación suave
  const light = new THREE.AmbientLight(0xffffff, 1.0);
  scene.add(light);

  // Cargar GLTF
  const loader = new GLTFLoader();
  loader.load(
    '/models/pizza.glb',
    gltf => {
      const model = gltf.scene;
      // Inclinar la pizza para verse en perspectiva
      model.rotation.x = THREE.MathUtils.degToRad(15);
      scene.add(model);

      // Animación: rotación continua
      const animate = () => {
        requestAnimationFrame(animate);
        model.rotation.y += 0.01; // gira lentamente
        renderer.render(scene, camera);
      };
      animate();
    },
    undefined,
    err => console.error('Error cargando pizza.glb:', err)
  );

  // Manejar resize si cambias tamaño (opcional)
  window.addEventListener('resize', () => {
    const w = container.clientWidth;
    const h = container.clientHeight;
    renderer.setSize(w, h);
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
  });
}
