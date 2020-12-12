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
                        <h3 class="card-title" ref="newUserNum">{{usersNum}}</h3>
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
                        <h3 class="card-title" ref="newMovieNum">{{ moviesNum }}</h3>
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
                        <h3 class="card-title" ref="newCommentNum">{{ commentsNum }}</h3>
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
                        <h3 class="card-title" ref="newRatingNum">{{ ratingsNum }}</h3>
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

        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Latest users</h4>
                        <p class="card-category">
                            New user <vue-moments-ago prefix="added" suffix="ago" :date="latestUser"></vue-moments-ago>
                        </p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Country</th>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" ref="newUser">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.username }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.country }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Latest movies</h4>
                        <p class="card-category">
                            New movie <vue-moments-ago prefix="added" suffix="ago" :date="latestMovie"></vue-moments-ago>
                        </p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Genre</th>
                                <th>Year</th>
                            </thead>
                            <tbody>
                            <tr v-for="movie in movies" ref="newMovie">
                                <td>{{ movie.id }}</td>
                                <td>{{ movie.name }}</td>
                                <td>{{ movie.genre }}</td>
                                <td>{{ movie.releaseYear }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Latest comments</h4>
                        <p class="card-category">
                            New comment <vue-moments-ago prefix="added" suffix="ago" :date="latestComment"></vue-moments-ago>
                        </p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>Movie</th>
                                <th>User</th>
                                <th>Content</th>
                            </thead>
                            <tbody>
                            <tr v-for="comment in comments" ref="newComment">
                                <td>{{ comment.commentable_id }}</td>
                                <td>{{ comment.user.username }}</td>
                                <td>{{ comment.content.substring(0,20)+"..." }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Latest ratings</h4>
                        <p class="card-category">
                            New rating <vue-moments-ago prefix="added" suffix="ago" :date="latestRating"></vue-moments-ago>
                        </p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th>Movie</th>
                                <th>User</th>
                                <th>Rating</th>
                            </thead>
                            <tbody>
                                <tr v-for="rating in ratings" ref="newRating">
                                    <td>{{ rating.movie.name }}</td>
                                    <td>{{ rating.user.username }}</td>
                                    <td><i class="fa fa-star"></i> {{ rating.rating }}/10 </td>
                                </tr>
                            </tbody>
                        </table>
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
            newElementInterval: null,
            movieUpdate: '',
            commentUpdate: '',
            ratingUpdate: '',
            userUpdate: '',
            latestUser: '',
            latestMovie: '',
            latestComment: '',
            latestRating: '',
            movies: '',
            users: '',
            ratings: '',
            comments: ''
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
                    this.moviesNum++
                    this.newElement(this.movieUpdate, this.latestMovie, this.movies, notification)
                    this.newElementStyle('newMovie')
                    this.newElementNumStyle('newMovieNum')
                }
                if(notification.type=="App\\\Notifications\\\NewComment") {
                    this.commentsNum++
                    this.newElement(this.commentUpdate, this.latestComment, this.comments, notification)
                    this.newElementStyle('newComment')
                    this.newElementNumStyle('newCommentNum')
                }
                if(notification.type=="App\\\Notifications\\\NewRating") {
                    this.ratingsNum++
                    this.newElement(this.ratingUpdate, this.latestRating, this.ratings, notification)
                    this.newElementStyle('newRating')
                    this.newElementNumStyle('newRatingNum')
                }
                if(notification.type=="App\\\Notifications\\\NewUser") {
                    this.usersNum++
                    this.newElement(this.userUpdate, this.latestUser, this.users, notification)
                    this.newElementStyle('newUser')
                    this.newElementNumStyle('newUserNum')
                }
            })
    },

    methods: {
        getStats() {
            this.movieUpdate = new Date().toJSON()
            this.userUpdate = new Date().toJSON()
            this.commentUpdate = new Date().toJSON()
            this.ratingUpdate = new Date().toJSON()

            axios.get('/getStats')
                .then(response => {
                    this.moviesNum = response.data.moviesNum
                    this.usersNum = response.data.usersNum
                    this.ratingsNum = response.data.ratingsNum
                    this.commentsNum = response.data.commentsNum
                    this.movies = response.data.movies
                    this.ratings = response.data.ratings
                    this.users = response.data.users
                    this.comments = response.data.comments
                    this.latestUser = response.data.users[0].created_at
                    this.latestMovie = response.data.movies[0].created_at
                    this.latestComment = response.data.comments[0].created_at
                    this.latestRating = response.data.ratings[0].created_at
                })
        },

        newElement(update, latest, array, notification) {
            update = notification.created_at
            latest = notification.created_at
            array.unshift(notification.data)
            array.splice(-1,1)
        },

        newElementStyle(property) {
            let $ref = this.$refs[property]
            $ref[0].style.backgroundColor = 'rgb(148,0,211,0.4)'
            $ref[0].style.transition = 'background-color 3s ease-out'
            this.newElementInterval = setTimeout(() => $ref[0].style.backgroundColor = '',4000)
        },

        newElementNumStyle(property) {
            let $ref = this.$refs[property]
            $ref.style.color = 'rgb(148,0,211,0.6)'
            $ref.style.transition = 'color 3s ease-out'
            this.newElementInterval = setTimeout(() => $ref.style.color = '#606477', 4000)
        }
    },

    beforeDestroy() {
        clearInterval(this.interval)
        clearInterval(this.newElementInterval)
    }
}
</script>

<style scoped>

</style>
