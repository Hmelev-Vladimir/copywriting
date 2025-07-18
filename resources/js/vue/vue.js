import { createApp } from 'vue';

const app = createApp();

import $auth from './global/$auth';
app.config.globalProperties.$auth = $auth;

app.config.globalProperties.appName = 'Портал копирайтеров';
app.config.globalProperties.appURL = 'http://copywriting';

import router from './router';
app.use(router);

import App from './components/App.vue';
app.component('App', App);

import Load from './components/global/Load.vue';
app.component('Load', Load);

import Alert from './components/global/Alert.vue';
app.component('Alert', Alert);

app.mount('#app');

export default app;

