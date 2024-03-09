import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { createPinia } from 'pinia'
// import dayjs from 'dayjs'
// import Swal from 'sweetalert2'

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
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';




// import ProgressBar from 'primevue/progressbar';
// import Checkbox from 'primevue/checkbox';
// import Layout from '@/Layouts/Admin'
// import gsap from 'gsap';
// import ProgressBar from 'vuejs-progress-bar'
import route from "ziggy-js";
import ToastService from 'primevue/toastservice';
const pinia = createPinia()
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
            .use(pinia)
            // .use(ProgressBar)
            // .use(InertiaProgress)
            // .use(ToastService)
            .use(gsap)
            .component('InputText',InputText)
            .component('Button',Button)
            .component('Dropdown',Dropdown)
            .component('Pagination',Pagination)
            .component('SpacedRule',SpacedRule)
            .component('LVProgressBar',LVProgressBar)
            // .component('ProgressBar',ProgressBar)

            // .component('Breadcrumb',Breadcrumb)
            .component('Checkbox',Checkbox)
            .component('MultiSelect',MultiSelect)
            // .component('Toast',Toast)
            .component('Breadcrumbs',Breadcrumbs)
            .component('FileUpload',FileUpload)
            .component('Textarea',Textarea)
            .component('TabPanel',TabPanel)
            .component('TabView',TabView)
            .component('Card',Card)
            // .component('DataView',DataView)

            .mixin({ methods: { route } })
            .mount(el);
    },
});
InertiaProgress.init()
