import './bootstrap';
import '../css/app.css';

import {createApp, h} from 'vue';
import {createInertiaApp, Head, Link} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy';
import {createPinia} from "pinia";
import {InertiaProgress} from "@inertiajs/progress";
import Layout from "@/Layouts/Layout.vue";
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core';
/* import the fontawesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const appName = import.meta.env.VITE_APP_NAME || 'Job Seeker';

createInertiaApp({
  title: (title) => `${title} | ${appName}`,
  resolve: (name) => {
    let page =  resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
    page.layout ??= Layout;
    return page;
  },
  setup({el, App, props, plugin}) {
    return createApp({render: () => h(App, props)})
      .use(plugin)
      .use(createPinia())
      .use(ZiggyVue)
      .component('Link', Link)
      .component('Head', Head)
      .component('font-awesome-icon', FontAwesomeIcon)
      .mount(el);
  },
  progress: {
    delay: 250,
    color: '#1d4ed8',
    showSpinner: false,
  }
});

InertiaProgress.init();
