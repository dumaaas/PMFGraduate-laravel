<template>
    <div>
        <a @click="showNotifications" class="notification">
            <span >Notifications</span>
            <span v-if="newNotifications.length > 0" class="badge">{{newNotifications.length}}</span>
        </a>
        <div class="not-block" v-if="showNot">
            <h1>New notifications</h1>
            <div v-if="newNotifications.length > 0">
                <div class="not-body" v-for="notification in newNotifications">
                    <div v-show="notification.type === 'App\\Notifications\\NewMovie'">
                        <img :src="'/images/movies/'+notification.data['avatar']" alt="">
                        <p>
                            <a :href="'/movies/'+notification.data['id']">
                                {{ notification.data['name'] }}
                            </a> <br> new movie,
                            <span class="time">
                                <vue-moments-ago prefix="" suffix="ago" :date="notification.created_at"></vue-moments-ago>
                            </span>
                        </p>
                    </div>
                    <div v-show="notification.type === 'App\\Notifications\\UserFollowed'">
                        <img  :src="'/images/users/'+notification.data['avatar']" alt="">
                        <p>
                            <a :href="'/users/'+notification.data['id']">
                                {{ notification.data['name'] }}
                            </a> <br>followed you,
                            <span class="time">
                                <vue-moments-ago prefix="" suffix="ago" :date="notification.created_at"></vue-moments-ago>
                            </span>
                        </p>
                    </div>
                    <div v-show="notification.type === 'App\\Notifications\\UserLike'">
                        <img :src="'/images/users/'+notification.data['avatar']" alt="">
                        <p>
                            <a :href="'/user/'+notification.data['id']">
                                {{ notification.data['name'] }}
                            </a> <br> liked your comment,
                            <span class="time">
                                <vue-moments-ago prefix="" suffix="ago" :date="notification.created_at"></vue-moments-ago>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div v-else>
                <a>No new notifications :)</a>
            </div>
            <h1>Earlier notifications</h1>
            <div class="not-body" v-for="notification in oldNotifications">
                <div v-show="notification.type === 'App\\Notifications\\NewMovie'">
                    <img :src="'/images/movies/'+notification.data['avatar']" alt="">
                    <p>
                        <a :href="'/movies/'+notification.data['id']">
                            {{ notification.data['name'] }}
                        </a> <br> new movie,
                        <span class="time">
                                <vue-moments-ago prefix="" suffix="ago" :date="notification.created_at"></vue-moments-ago>
                            </span>
                    </p>
                </div>
                <div v-show="notification.type === 'App\\Notifications\\UserFollowed'">
                    <img  :src="'/images/users/'+notification.data['avatar']" alt="">
                    <p>
                        <a :href="'/users/'+notification.data['id']">
                            {{ notification.data['name'] }}
                        </a> <br> followed you,
                        <span class="time">
                                <vue-moments-ago prefix="" suffix="ago" :date="notification.created_at"></vue-moments-ago>
                            </span>
                    </p>
                </div>
                <div v-show="notification.type === 'App\\Notifications\\UserLike'">
                    <img :src="'/images/users/'+notification.data['avatar']" alt="">
                    <p>
                        <a :href="'/user/'+notification.data['id']">
                            {{ notification.data['name'] }}
                        </a> <br> liked your comment,
                        <span class="time">
                                <vue-moments-ago prefix="" suffix="ago" :date="notification.created_at"></vue-moments-ago>
                            </span>
                    </p>
                </div>
            </div>
            <hr>
            <a href="/notifications">Show all notifications</a>
        </div>
    </div>
</template>

<script>
import VueMomentsAgo from 'vue-moments-ago';
export default {

    props: {
        user: ''
    },

    components: {
        VueMomentsAgo
    },

    data() {
        return {
            showNot: false,
            oldNotifications: '',
            newNotifications: '',
            showNotNumber: true
        }
    },

    mounted() {
        axios.get('/getNotifications')
            .then(response => {
                this.oldNotifications = response.data.oldNotifications
                this.newNotifications = response.data.newNotifications
            })
    },

    created() {

        Echo.private('App.User.' +this.user.id)
            .notification((notification) => {
                this.newNotifications.unshift(notification)
                console.log(notification)
            })

    },

    methods: {
        showNotifications() {
            this.showNot = !this.showNot
            setTimeout(() =>
                axios.get('/markAsReadNotifications')
                    .then(response => {
                        this.newNotifications = response.data.newNotifications
                        this.oldNotifications = response.data.oldNotifications
                    }), 5000);
        },
    }
}
</script>

<style scoped>
    .notification {
        background-color: transparent;
        color: white;
        text-decoration: none;
        padding: 15px 26px;
        position: relative;
        display: inline-block;
        border-radius: 2px;
    }

    .notification .badge {
        position: absolute;
        top: -7px;
        right: 0px;
        padding: 5px 10px;
        border-radius: 50%;
        background: red;
        color: white;
    }

    .not-block {
        position: absolute;
        width: 300px;
        padding: 10px 20px;
        background-color: #020D18;
        border-radius: 20px;
    }


    .not-block h1 {
        font-size: 20px;
        color: #233A50;
    }

    .not-block p {
        position: absolute;
        margin-left: 60px;
        margin-top: -45px;
    }

    .not-block a {
        text-align: center;
        font-size: 15px;
        color: #367C8E;
    }

    .not-body {
        margin-bottom: 8px;
    }

    img {
        width:  50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
    }

</style>
