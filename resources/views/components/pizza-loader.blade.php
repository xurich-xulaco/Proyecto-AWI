{{-- resources/views/components/pizza-loader.blade.php --}}
<div id="pizza-loader" style="width:40px;height:40px;">
  <canvas id="canvas-pizza"></canvas>
</div>

@once
@push('scripts')
<script type="module">
  import * as THREE from 'three';
  // crea escena, cámara y renderer
  const renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('canvas-pizza'), alpha: true });
  renderer.setSize(40,40);
  const scene = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(45,1,0.1,100);
  camera.position.z = 3;
  // modelo low-poly (puedes sustituir URL por asset local)
  const loader = new THREE.GLTFLoader();
  loader.load('{{ asset("models/pizza.glb") }}', gltf => {
    scene.add(gltf.scene);
    animate();
  });
  function animate(){
    requestAnimationFrame(animate);
    scene.rotation.y += 0.02;
    renderer.render(scene,camera);
  }
</script>
@endpush
@endonce
