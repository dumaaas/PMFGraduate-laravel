import Form from './classes/Form.js'
import EditPassword from "./components/Forms/EditPassword";
import EditDetails from "./components/Forms/EditDetails";
import EditPrivacy from "./components/Forms/EditPrivacy";

require('./bootstrap');

window.Form = Form;
window.Vue = require('vue');

Vue.component('edit-password', EditPassword);
Vue.component('edit-details', EditDetails);
Vue.component('edit-privacy', EditPrivacy);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
