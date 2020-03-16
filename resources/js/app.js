require('./bootstrap');

window.Vue = require('vue');

//Costum components
import PCreateButtom from "./components/buttons/PCreateButtom";
import PCategoryForm from "./components/forms/PCategoryForm";
import PTextInputWithValidation from "./components/inputs/PTextInputWithValidation";
import PCategoriesTable from "./components/tables/PCategoriesTable";
import PModal from "./components/PModal";
import PModalRoot from "./components/PModalRoot";
import PShowCategory from "./components/PShowCategory";
import PCreateModal from "./components/PCreateModal";

Vue.component("p-create-buttom", PCreateButtom);
Vue.component("p-category-form", PCategoryForm);
Vue.component("p-text-input", PTextInputWithValidation);
Vue.component("p-categories-table", PCategoriesTable);
Vue.component("p-modal", PModal);
Vue.component("p-modal-root", PModalRoot);
Vue.component("p-show-category", PShowCategory);
Vue.component("p-create-modal", PCreateModal);

//Costum formatters
import { percentageFormatter } from "./formatter"

Vue.filter('percentage', percentageFormatter)

// Bootstrap-vue
import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);

//Vee-Validate
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

// Vue-font-awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { faEye, faEdit, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faEye, faEdit, faTrash)

Vue.component('font-awesome-icon', FontAwesomeIcon)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
