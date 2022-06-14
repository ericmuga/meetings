import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
// import dayjs from 'dayjs'

    import gsap from 'gsap';
 import PrimeVue from 'primevue/config'
 import InputText from 'primevue/inputtext'
//  import Toast from 'primevue/toast'
 import Button from 'primevue/button'
 import 'primevue/resources/themes/saga-blue/theme.css'       //theme
 import 'primevue/resources/primevue.min.css'                 //core css
 import 'primeicons/primeicons.css'
 import SelectButton from 'primevue/selectbutton';                        //icons
 import Dropdown from 'primevue/dropdown';
 import Checkbox from 'primevue/checkbox';
 import Textarea from 'primevue/textarea';
 import Card from 'primevue/card';
//  import DataView from 'primevue/dataview';
//  import Breadcrumb from 'primevue/breadcrumb';\
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import FileUpload from 'primevue/fileupload';
import Pagination from '@/Components/Pagination.vue'
import SpacedRule from '@/Components/SpacedRule.vue'
import MultiSelect from 'primevue/multiselect';
import InputNumber from 'primevue/inputnumber';
// import Checkbox from 'primevue/checkbox';
// import Layout from '@/Layouts/Admin'
// import gsap from 'gsap';

import route from "ziggy-js";
import ToastService from 'primevue/toastservice';

createInertiaApp({
    // title: (title) => `${title} - ${appName}`,
    resolve: name=>{
                      let page= require(`./Pages/${name}`).default;
                    //   page.layout??=Layout;
                      return page;
                     },

    setup({ el, app, props, plugin }) {
        const VueApp = createApp({ render: () => h(app, props) });

        // VueApp.config.globalProperties.$date = dayjs;

        VueApp.use(plugin)
             .component("Link",Link)
            .use(PrimeVue)
            // .use(InertiaProgress)
            // .use(ToastService)
            .use(gsap)
            .Component('InputText',InputText)
            .Component('Button',Button)
            .Component('Dropdown',Dropdown)
            .Component('Pagination',Pagination)
            .Component('SpacedRule',SpacedRule)

            // .Component('Breadcrumb',Breadcrumb)
            .Component('Checkbox',Checkbox)
            .Component('MultiSelect',MultiSelect)
            // .Component('Toast',Toast)
            .Component('Breadcrumbs',Breadcrumbs)
            .Component('FileUpload',FileUpload)
            .Component('Textarea',Textarea)
            .Component('InputNumber',InputNumber)
            .Component('Card',Card)
            // .Component('DataView',DataView)

            .mixin({ methods: { route } })
            .mount(el);
    },
});
InertiaProgress.init()
