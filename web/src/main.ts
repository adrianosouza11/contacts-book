import { createApp } from 'vue';
import App from './App.vue'
import router from './router';
import { createPinia  } from 'pinia';
import ToastPlugin from '@/plugins/toast';

import './assets/tailwind.css'

const app = createApp(App);

app.use(router);
app.use(createPinia());
app.use(ToastPlugin);

app.mount('#app');
