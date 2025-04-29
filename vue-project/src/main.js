// import './assets/main.css'
import './assets/themes.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const theme = localStorage.getItem('theme') || 'light';
document.documentElement.setAttribute('data-theme', theme);

createApp(App)
  .use(router)
  .mount('#app')



