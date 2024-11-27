import { createApp } from 'vue/dist/vue.esm-bundler';
const app = createApp();
import $auth from './global/$auth';
app.config.globalProperties.$auth = $auth;
import router from './router';
app.use(router);
import App from './components/App.vue';
app.component('App', App);
app.mount('#app');
export default app;

