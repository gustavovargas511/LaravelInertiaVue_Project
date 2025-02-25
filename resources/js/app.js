import './bootstrap';
import '../css/app.css';

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3"; //Global imports from Inertia, will be available in all pages
import {ZiggyVue} from "../../vendor/tightenco/ziggy";
import LayoutContainer from "./Layouts/LayoutContainer.vue"

createInertiaApp({
    title: (title) => `${title} Laravel + Inertia + Vue3`, // title template
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        // return pages[`./Pages/${name}.vue`];
        // we gonna set a default layout for all pages
        let page = pages[`./Pages/${name}.vue`];
        // if the page does not have a layout, we will set the default layout
        page.default.layout = page.default.layout || LayoutContainer;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("Head", Head) // add the Head component so there is no need to import it in every page
            .component("Link", Link) // add the Link component, same as Head
            .mount(el);
    },
    // progress: {
    //     // The color of the progress bar...
    //     color: "#fff",

    //     // Whether to include the default NProgress styles...
    //     includeCSS: true,

    //     // Whether the NProgress spinner will be shown...
    //     showSpinner: false,
    // },
});