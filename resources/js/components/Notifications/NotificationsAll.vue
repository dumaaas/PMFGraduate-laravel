<template>
    <div>
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div id="comments" class="tab blog-detail-ct">
                <h4>Today notifications</h4>
                <div v-for="n in notifications">
                    <div v-show="n.created_at.includes(currentDate)">
                        <div v-show="n.type === 'App\\Notifications\\NewMovie'" class="cmt-item flex-it">
                            <img :src="'/images/movies/'+n.data['avatar']">
                            <div class="author-infor">
                                <div class="flex-it2">
                                    <p>
                                        <a :href="'/users/'+n.data['id']">
                                            {{ n.data['name'] }}
                                        </a> new movie<br> <br>
                                        <span class="time">
                                        <vue-moments-ago prefix="" suffix="ago" :date="n.created_at"></vue-moments-ago>
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div v-show="n.type === 'App\\Notifications\\UserFollowed'" class="cmt-item flex-it">
                            <img :src="'/images/users/'+n.data['avatar']">
                            <div class="author-infor">
                                <div class="flex-it2">
                                    <p>
                                        <a :href="'/users/'+n.data['id']">
                                            {{ n.data['name'] }}
                                        </a> followed you <br> <br>
                                        <span class="time">
                                        <vue-moments-ago prefix="" suffix="ago" :date="n.created_at"></vue-moments-ago>
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div v-show="n.type === 'App\\Notifications\\UserLike'" class="cmt-item flex-it">
                            <img :src="'/images/users/'+n.data['avatar']">
                            <div class="author-infor">
                                <div class="flex-it2">
                                    <p>
                                        <a :href="'/users/'+n.data['id']">
                                            {{ n.data['name'] }}
                                        </a> liked your comment <br> <br>
                                        <span class="time">
                                        <vue-moments-ago prefix="" suffix="ago" :date="n.created_at"></vue-moments-ago>
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div id="comments" class="tab blog-detail-ct">
                <h4>Earlier notifications</h4>
                <div v-for="n in notifications">
                    <div v-show="!n.created_at.includes(currentDate)">
                        <div v-show="n.type === 'App\\Notifications\\NewMovie'" class="cmt-item flex-it">
                            <img :src="'/images/movies/'+n.data['avatar']">
                            <div class="author-infor">
                                <div class="flex-it2">
                                    <p>
                                        <a :href="'/users/'+n.data['id']">
                                            {{ n.data['name'] }}
                                        </a> new movie<br> <br>
                                        <span class="time">
                                        <vue-moments-ago prefix="" suffix="ago" :date="n.created_at"></vue-moments-ago>
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div v-show="n.type === 'App\\Notifications\\UserFollowed'" class="cmt-item flex-it">
                            <img :src="'/images/users/'+n.data['avatar']">
                            <div class="author-infor">
                                <div class="flex-it2">
                                    <p>
                                        <a :href="'/users/'+n.data['id']">
                                            {{ n.data['name'] }}
                                        </a> followed you <br> <br>
                                        <span class="time">
                                        <vue-moments-ago prefix="" suffix="ago" :date="n.created_at"></vue-moments-ago>
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div v-show="n.type === 'App\\Notifications\\UserLike'" class="cmt-item flex-it">
                            <img :src="'/images/users/'+n.data['avatar']">
                            <div class="author-infor">
                                <div class="flex-it2">
                                    <p>
                                        <a :href="'/users/'+n.data['id']">
                                            {{ n.data['name'] }}
                                        </a> liked your comment <br> <br>
                                        <span class="time">
                                        <vue-moments-ago prefix="" suffix="ago" :date="n.created_at"></vue-moments-ago>
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</template>

<script>

import VueMomentsAgo from "vue-moments-ago";
export default {
    props: {
        default_notifications: '',
        user: ''
    },

    components: {
        VueMomentsAgo
    },

    data() {
        return {
            currentDate: new Date().toJSON().slice(0,10).replace(/-/g,'-'),
            notifications: this.default_notifications
        }
    },

    created() {
        Echo.private('App.User.' +this.user.id)
            .notification((notification) => {
                this.notifications.unshift(notification)
                console.log(notification)
            })
    }

}
</script>

<style scoped>
    img {
        width:  85px;
        height: 85px;
        object-fit: cover;
        border-radius: 50%;
    }
</style>
