require('./bootstrap');

window.Vue = require('vue');

//Custom components
import PCreateButton from "./components/buttons/PCreateButton";
import PCategoryForm from "./components/forms/PCategoryForm";
import PTextInput from "./components/inputs/PTextInput";
import PCategoriesTable from "./components/tables/PCategoriesTable";
import PModal from "./components/PModal";
import PModalRoot from "./components/PModalRoot";
import PShowCategory from "./components/PShowCategory";
import PCreateModal from "./components/PCreateModal";

Vue.component("p-create-button", PCreateButton);
Vue.component("p-category-form", PCategoryForm);
Vue.component("p-text-input", PTextInput);
Vue.component("p-categories-table", PCategoriesTable);
Vue.component("p-modal", PModal);
Vue.component("p-modal-root", PModalRoot);
Vue.component("p-show-category", PShowCategory);
Vue.component("p-create-modal", PCreateModal);

//Custom formatters
import { percentageFormatter } from "./formatter"
import { dateTimeFormatter} from "./formatter"

Vue.filter('percentage', percentageFormatter)
Vue.filter('dateTime', dateTimeFormatter)

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

//Translation
import _ from "lodash"
window.Vue.prototype.trans = string => _.get(window.i18n, string)

window.Vue.prototype.transChoice = (string, plural, args) => {
    let value = _.get(window.i18n, string);

    if (plural === 1) {
        value = value.split('|')[0];
    } else if (plural === 0 || plural > 1) {
        value = value.split('|')[1];
    }

    _.eachRight(args, (paramVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, paramVal);
    });
    return value;
}
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
