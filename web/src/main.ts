import { createApp } from 'vue';
import App from './App.vue'
import router from './router';
import { createPinia  } from 'pinia';
import ToastPlugin from '@/plugins/toast';
import { vMaska} from 'maska/vue';

import './assets/tailwind.css'

const app = createApp(App);

app.use(router);
app.use(createPinia());
app.use(ToastPlugin);

app.directive('maska', vMaska);

app.mount('#app');
