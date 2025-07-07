import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000/api'; // or your Laravel backend
axios.defaults.withCredentials = true; // if using cookies
// axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.timeout = 5000; // ✅ Fix here
window.axios = axios;
