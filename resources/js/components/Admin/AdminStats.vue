<template>
    <div>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <p class="card-category">Users</p>
                        <h3 class="card-title">{{usersNum}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i>
                            <vue-moments-ago prefix="updated" suffix="ago" :date="userUpdate"></vue-moments-ago>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-film"></i>
                        </div>
                        <p class="card-category">Movies</p>
                        <h3 class="card-title">{{ moviesNum }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i>
                            <vue-moments-ago prefix="updated" suffix="ago" :date="movieUpdate"></vue-moments-ago>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-comment"></i>
                        </div>
                        <p class="card-category">Comments</p>
                        <h3 class="card-title">{{ commentsNum }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i>
                            <vue-moments-ago prefix="updated" suffix="ago" :date="commentUpdate"></vue-moments-ago>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <p class="card-category">Ratings</p>
                        <h3 class="card-title">{{ ratingsNum }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i>
                            <vue-moments-ago prefix="updated" suffix="ago" :date="ratingUpdate"></vue-moments-ago>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import VueMomentsAgo from "vue-moments-ago";
export default {

    components: {
        VueMomentsAgo
    },

    props: {
        user: '',
    },

    data() {
        return {
            moviesNum: '',
            commentsNum: '',
            ratingsNum: '',
            usersNum: '',
            interval: null,
            movieUpdate: '',
            commentUpdate: '',
            ratingUpdate: '',
            userUpdate: '',
        }
    },

    mounted() {
        this.getStats();
    },

    created() {
        this.interval = setInterval(() => this.getStats(), 600*1000)
        Echo.private('App.User.' +this.user.id)
            .notification((notification) => {
                if(notification.type=="App\\\Notifications\\\NewMovie") {
                    this.moviesNum++;
                    this.movieUpdate = notification.created_at;
                }
                if(notification.type=="App\\\Notifications\\\NewComment") {
                    this.commentsNum++;
                    this.commentUpdate = notification.created_at;
                    console.log(this.commentUpdate);

                }
                if(notification.type=="App\\\Notifications\\\NewRating") {
                    this.ratingsNum++;
                    this.ratingUpdate = notification.created_at;
                }
                if(notification.type=="App\\\Notifications\\\NewUser") {
                    this.usersNum++;
                    this.userUpdate = notification.created_at;
                }
                console.log(notification)
            })
    },

    methods: {
        getStats() {
            this.movieUpdate = new Date().toJSON()
            this.userUpdate = new Date().toJSON()
            this.commentUpdate = new Date().toJSON()
            this.ratingUpdate = new Date().toJSON()
            console.log(this.commentUpdate);

            axios.get('/getStats')
                .then(response => {
                    this.moviesNum = response.data.moviesNum
                    this.usersNum = response.data.usersNum
                    this.ratingsNum = response.data.ratingsNum
                    this.commentsNum = response.data.commentsNum
                })
        }
    },

    beforeDestroy() {
        clearInterval(this.interval)
    }

}
</script>

<style scoped>

</style>
