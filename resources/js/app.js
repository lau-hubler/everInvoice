require("./bootstrap");

window.Vue = require("vue");

//Custom components
import PCreateButton from "./components/buttons/PCreateButton";
import PDeleteButton from "./components/buttons/PDeleteButton";
import PLinkButton from "./components/buttons/PLinkButton";
Vue.component("p-create-button", PCreateButton);
Vue.component("p-delete-button", PDeleteButton);
Vue.component("p-link-button", PLinkButton);

import PCategoriesTable from "./components/models/category/PCategoriesTable";
import PCategoryDetails from "./components/models/category/PCategoryDetails";
import PCreateCategory from "./components/models/category/PCreateCategory";
import PUpdateCategory from "./components/models/category/PUpdateCategory";
Vue.component("p-create-category", PCreateCategory);
Vue.component("p-update-category", PUpdateCategory);
Vue.component("p-category-details", PCategoryDetails);
Vue.component("p-categories-table", PCategoriesTable);


import PCategoryForm from "./components/forms/PCategoryForm.vue";
Vue.component("p-category-form", PCategoryForm);

import PTextInput from "./components/inputs/PTextInput";
Vue.component("p-text-input", PTextInput);

import PCrudModal from "./components/PCrudModal";
import PModalFooter from "./components/PModalFooter";
Vue.component("p-crud-modal", PCrudModal);
Vue.component("p-modal-footer", PModalFooter);

//Custom formatters
import { percentageFormatter } from "./formatter";
import { dateTimeFormatter } from "./formatter";

Vue.filter("percentage", percentageFormatter);
Vue.filter("dateTime", dateTimeFormatter);

// Bootstrap-vue
import BootstrapVue from "bootstrap-vue";
Vue.use(BootstrapVue);

//Vee-Validate
import VeeValidate from "vee-validate";
Vue.use(VeeValidate);

// Vue-font-awesome
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faEye,
    faEdit,
    faTrash,
    faTimes,
    faSave,
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faEye, faEdit, faTrash, faTimes, faSave);

Vue.component("font-awesome-icon", FontAwesomeIcon);

//Translation
import _ from "lodash";
window.Vue.prototype.trans = (string) => _.get(window.i18n, string);

window.Vue.prototype.transChoice = (string, plural, args) => {
    let value = _.get(window.i18n, string);

    if (plural === 1) {
        value = value.split("|")[0];
    } else if (plural === 0 || plural > 1) {
        value = value.split("|")[1];
    }

    _.eachRight(args, (paramVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, paramVal);
    });
    return value;
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});
