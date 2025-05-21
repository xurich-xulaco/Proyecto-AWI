import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { gsap } from 'gsap';

export class PizzaLoader {
    constructor(container) {
        this.container = container;
        this.init();
    }
    
    init() {
        // Create scene
        this.scene = new THREE.Scene();
        this.scene.background = new THREE.Color(0x241F31); // Adwaita dark background
        
        // Create camera
        this.camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
        this.camera.position.set(0, 5, 10);
        
        // Create renderer
        this.renderer = new THREE.WebGLRenderer({ antialias: true });
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.renderer.setPixelRatio(window.devicePixelRatio);
        this.container.appendChild(this.renderer.domElement);
        
        // Add lights
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
        this.scene.add(ambientLight);
        
        const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
        directionalLight.position.set(5, 10, 7.5);
        this.scene.add(directionalLight);
        
        // Create a fallback pizza shape if model loading fails
        this.createFallbackPizza();
        
        // Try to load the 3D model
        this.loadPizzaModel();
        
        // Start animation loop
        this.animate();
        
        // Handle window resize
        window.addEventListener('resize', this.handleResize.bind(this));
    }
    
    createFallbackPizza() {
        // Create a simple pizza shape as fallback
        const geometry = new THREE.CylinderGeometry(5, 5, 0.5, 32);
        const material = new THREE.MeshStandardMaterial({ color: 0xF5CF87 });
        this.pizza = new THREE.Mesh(geometry, material);
        
        // Add tomato sauce (red top)
        const toppingGeometry = new THREE.CylinderGeometry(4.8, 4.8, 0.2, 32);
        const toppingMaterial = new THREE.MeshStandardMaterial({ color: 0xED333B });
        const topping = new THREE.Mesh(toppingGeometry, toppingMaterial);
        topping.position.y = 0.3;
        this.pizza.add(topping);
        
        // Add some pepperoni
        for (let i = 0; i < 8; i++) {
            const pepperoniGeometry = new THREE.CylinderGeometry(0.5, 0.5, 0.1, 16);
            const pepperoniMaterial = new THREE.MeshStandardMaterial({ color: 0xC01C28 });
            const pepperoni = new THREE.Mesh(pepperoniGeometry, pepperoniMaterial);
            
            // Random position on pizza
            const angle = Math.random() * Math.PI * 2;
            const radius = Math.random() * 3.5;
            pepperoni.position.x = Math.cos(angle) * radius;
            pepperoni.position.z = Math.sin(angle) * radius;
            pepperoni.position.y = 0.4;
            
            this.pizza.add(pepperoni);
        }
        
        this.scene.add(this.pizza);
        
        // Animate the pizza
        gsap.to(this.pizza.rotation, {
            y: Math.PI * 2,
            duration: 8,
            repeat: -1,
            ease: "none"
        });
        
        gsap.to(this.pizza.position, {
            y: 1,
            duration: 1.5,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut"
        });
    }
    
    loadPizzaModel() {
        const loader = new GLTFLoader();
        
        loader.load('/models/pizza.glb', 
            // onLoad callback
            (gltf) => {
                // Remove fallback pizza if it exists
                if (this.pizza) {
                    this.scene.remove(this.pizza);
                }
                
                this.pizza = gltf.scene;
                this.pizza.scale.set(2, 2, 2);
                this.scene.add(this.pizza);
                
                // Animate the pizza
                gsap.to(this.pizza.rotation, {
                    y: Math.PI * 2,
                    duration: 8,
                    repeat: -1,
                    ease: "none"
                });
                
                gsap.to(this.pizza.position, {
                    y: 1,
                    duration: 1.5,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut"
                });
            },
            // onProgress callback
            (xhr) => {
                console.log((xhr.loaded / xhr.total * 100) + '% loaded');
            },
            // onError callback
            (error) => {
                console.error('An error happened loading the model', error);
                // Fallback already created
            }
        );
    }
    
    animate() {
        requestAnimationFrame(this.animate.bind(this));
        this.renderer.render(this.scene, this.camera);
    }
    
    handleResize() {
        this.camera.aspect = window.innerWidth / window.innerHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(window.innerWidth, window.innerHeight);
    }
    
    show() {
        this.container.style.display = 'block';
    }
    
    hide() {
        this.container.style.display = 'none';
    }
}