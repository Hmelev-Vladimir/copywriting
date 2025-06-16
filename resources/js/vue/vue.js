import { createApp } from 'vue';

const app = createApp();

import $auth from './global/$auth';
app.config.globalProperties.$auth = $auth;

app.config.globalProperties.appName = 'Портал копирайтеров';

import router from './router';
app.use(router);

import App from './components/App.vue';
app.component('App', App);

import Load from './components/mods/Load.vue';
app.component('Load', Load);

app.mount('#app');

export default app;

