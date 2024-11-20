// Импорт, глобальное подключение и настройка библиотеки Axios.
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// Базовый адрес сайта. Нужно поменять на актуальный.
window.axios.defaults.baseURL = "http://copywriting";

// Импорт экземпляра приложения Vue.
import app from './vue/vue';
