import Toast, { type PluginOptions } from 'vue-toastification';
import type { App } from 'vue';
import 'vue-toastification/dist/index.css';

const options: PluginOptions = {
  position: 'top-center',
  timeout: 3000,
  closeOnClick: true,
  pauseOnHover: true,
  draggable: true,
  hideProgressBar: false,
  toastClassName: 'rounded-lg shadow-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100'
}

export default {
  install(app: App) {
    app.use(Toast, options);
  },
}