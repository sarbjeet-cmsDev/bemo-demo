import './bootstrap';
import { createApp } from 'vue'
import '../css/main.css'; // ✅ must be here

import router from './router';
import App from './App.vue';

const app = createApp(App);
app.use(router);
app.mount('#app')
