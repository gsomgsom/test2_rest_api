import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import { createRouter, createWebHistory } from 'vue-router';
import ItemsList from './components/pages/ItemsList';
import ItemCreate from './components/pages/ItemCreate';
import ItemEdit from './components/pages/ItemEdit';
import ItemShow from './components/pages/ItemShow';
  
axios.defaults.baseURL = process.env.VUE_APP_API_URL
axios.interceptors.request.use(function (config) {
  config.headers['Authorization'] = 'Basic ' + btoa(process.env.VUE_APP_API_USER + ':' + process.env.VUE_APP_API_PASS);
  return config;
});
  
const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: ItemsList },
    { path: '/create', component: ItemCreate },
    { path: '/edit/:id', component: ItemEdit },
    { path: '/show/:id', component: ItemShow },
  ],
});
  
createApp(App).use(router).mount('#app');
