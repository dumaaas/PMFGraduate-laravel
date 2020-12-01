<template>
    <div>
        <a @click.prevent="showNotifications" class="notification">
            <span >Notifications</span>
            <span v-if="notifications.length > 0" class="badge">{{notifications.length}}</span>
        </a>
        <div class="not-block" v-if="showNot">
            <h1>New notifications</h1>
            <div class="not-body" v-for="notification in notifications">
                <img :src="'/images/users/'+notification.data['follower_avatar']" alt="" style="border-radius: 50%"
                     width="50px" height="50px">
                        <p>
                            <a :href="'/users/'+notification.data['follower_id']">
                                {{ notification.data['follower_firstName'] }}
                                {{ notification.data['follower_lastName'] }}
                            </a> &nbsp followed you
                        <br>
                        <span class="time">
                            <vue-moments-ago prefix="" suffix="ago" :date="notification.created_at"></vue-moments-ago>
                        </span>
                        </p>
            </div>
            <h1>Earlier notifications</h1>
            <div class="not-body" v-for="notification in notifications">
                <img :src="'/images/users/'+notification.data['follower_avatar']" alt="" style="border-radius: 50%"
                     width="50px" height="50px">
                <p>
                    <a :href="'/users/'+notification.data['follower_id']">
                        {{ notification.data['follower_firstName'] }}
                        {{ notification.data['follower_lastName'] }}
                    </a> &nbsp followed you
                    <br>
                    <span class="time">
                            <vue-moments-ago prefix="" suffix="ago" :date="notification.created_at"></vue-moments-ago>
                        </span>
                </p>
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
            notifications: '',
        }
    },

    mounted() {
        axios.get('/getNotifications')
            .then(response => {
                this.notifications = response.data
            })
    },

    created() {

        Echo.private('App.User.' +this.user.id)
            .notification((notification) => {
                console.log(notification);
                this.notifications.push(notification);
            })

    },

    methods: {
        showNotifications() {
            this.showNot = !this.showNot
            console.log(this.notifications)
        }
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

</style>
