import Form from './classes/Form.js'
import EditPassword from "./components/User/EditPassword";
import EditDetails from "./components/User/EditDetails";
import EditPrivacy from "./components/User/EditPrivacy";
import MovieIndex from "./components/Movie/MovieIndex";
import MovieList from "./components/Movie/MovieList";
import MovieReminder from "./components/Movie/MovieReminder";
import MovieShow from "./components/Movie/MovieShow";
import Comments from "./components/Movie/Comments";
import Comment from "./components/Movie/Comment";
import Replies from "./components/Movie/Replies";
import NotificationsNav from "./components/Notifications/NotificationsNav";
import NotificationsAll from "./components/Notifications/NotificationsAll";
import AdminStats from "./components/Admin/AdminStats";
import UserList from "./components/Admin/UserList";
import MovieTable from "./components/Admin/MovieTable";

require('./bootstrap');

window.numeral = require('numeral')
window.Form = Form;
window.Vue = require('vue');

Vue.component('edit-password', EditPassword);
Vue.component('edit-details', EditDetails);
Vue.component('edit-privacy', EditPrivacy);
Vue.component('movie-index', MovieIndex);
Vue.component('movie-list', MovieList);
Vue.component('movie-reminder', MovieReminder);
Vue.component('movie-show', MovieShow);
Vue.component('comments', Comments);
Vue.component('comment', Comment);
Vue.component('replies', Replies);
Vue.component('notifications-nav', NotificationsNav)
Vue.component('notifications-all', NotificationsAll);
Vue.component('admin-stats', AdminStats);
Vue.component('user-list', UserList);
Vue.component('movie-table', MovieTable);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
