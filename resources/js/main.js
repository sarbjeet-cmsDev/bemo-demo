import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

// Import BEM-based CSS Design System
import './assets/css/main.css'

createApp(App).use(router).mount('#app')