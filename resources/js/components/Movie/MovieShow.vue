<template>
    <div>
        <div>
            <div class="hero mv-single-hero">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-single movie-single movie_single">
            <div class="container">
                <div class="row ipad-width2">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="movie-img">
                            <img :src="'/images/movies/'+movie.avatar" alt="">
                            <div class="movie-btn">
                                <div class="btn-transform transform-vertical red">
                                    <div>
                                        <a href="#" class="item item-1 redbtn">
                                            <i class="ion-play"></i> Watch Trailer
                                        </a>
                                    </div>
                                    <div>
                                        <a :href="movie.trailer" class="item item-2 redbtn fancybox-media hvr-grow">
                                            <i class="ion-play"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="btn-transform transform-vertical">
                                    <div>
                                        <a class="item item-1 yellowbtn">
                                            <i class="ion-checkmark"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a class="item item-2 yellowbtn">
                                            <movie-list :type="'watched'" :movie="movie" :isinmovielist="isinwatched"></movie-list>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-btn">
                                <movie-reminder :movie="movie"></movie-reminder>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="movie-single-ct main-content">
                            <h1 class="bd-hd">{{ movie.name }} <span> {{ movie.releaseYear }}</span></h1>
                            <div class="social-btn">
                                <movie-list :type="'favorite'" :movie="movie" :isinmovielist="isinfavorite"></movie-list>
                                <movie-list :type="'custom'" :movie="movie" :isinmovielist="isincustom"></movie-list>
                                <movie-list :type="'watchlist'" :movie="movie" :isinmovielist="isinwatchlist"></movie-list>
                            </div>
                            <div class="movie-rate">
                                <div class="rate">
                                    <i class="ion-android-star"></i>
                                    <p><span>{{ movieRating }}</span> /10<br>
                                        <span class="rv">{{ ratingNum }} reviews</span>
                                    </p>
                                </div>
                                <div class="rate-star">
                                    <p>Rate This Movie: </p>
                                    <Rate @rating-selected="setRating" :rating="userRating" :activeColor="'#FFFF00'" :star-size="30" :animate="true" :maxRating="10" :showRating="false"></Rate>
                                </div>
                            </div>
                            <div class="movie-tabs">
                                <div class="tabs">
                                    <ul class="cont4 tab-links tabs-mv">
                                        <li class="active"><a href="#overview">Overview</a></li>
                                        <li><a href="#comments">Comments</a></li>
                                        <li><a href="#reviews">Reviews</a></li>
                                    </ul>
                                    <br>
                                    <div class="tab-content">
                                        <div id="overview" class="tab active">
                                            <div class="row">
                                                <div class=" cont1 col-md-8 col-sm-12 col-xs-12">
                                                    <div class=" title-hd-sm">
                                                        <h4>About <i class="ion-ios-arrow-right"></i></h4>
                                                    </div>
                                                    <p>{{ movie.description }}</p>
                                                    <div class="title-hd-sm">
                                                        <h4>Full Cast & Crew <i class="ion-ios-arrow-right"></i></h4>
                                                    </div>
                                                    <div v-for="acting in actings" class="mvcast-item">
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <img :src="'/images/actors/'+acting.cast.avatar"
                                                                     style="width:60px; height:70px; float:left; border-radius:50%; margin-right:25px;"
                                                                     alt="">
                                                                <a :href="'/cast/'+acting.cast.id">{{ acting.cast.firstName}}
                                                                    {{ acting.cast.lastName }} </a>
                                                            </div>
                                                            <p>... {{ acting.cast.movieName }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="cont2 col-md-4 col-xs-12 col-sm-12">
                                                    <div class="sb-it">
                                                        <h6>Director: </h6>
                                                        <p>
                                                            David Fincher
                                                        </p>
                                                    </div>
                                                    <div class="sb-it">
                                                        <h6>Stars: </h6>
                                                        <p>
                                                            <a v-for="star in stars" :href="'/cast/'+star.cast.id">
                                                                {{ star.cast.firstName }} {{ star.cast.lastName }}
                                                                <br/>
                                                            </a>
                                                        </p>
                                                    </div>
                                                    <div class="sb-it">
                                                        <h6>Genre:</h6>
                                                        <p><a href="#">{{ movie.genre}}</a></p>
                                                    </div>
                                                    <div class="sb-it">
                                                        <h6>Release Date:</h6>
                                                        <p>{{ movie.releaseYear}}</p>
                                                    </div>
                                                    <div class="sb-it">
                                                        <h6>Run Time:</h6>
                                                        <p>{{ movie.duration}} min</p>
                                                    </div>
                                                    <div class="sb-it">
                                                        <h6>imDB Rating:</h6>
                                                        <p>{{ movie.imdb}}/10</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="comments" class="tab blog-detail-ct">
                                            <comments :movie="movie"></comments>
                                        </div>
                                        <div id="reviews" class="tab blog-detail-ct">
                                            <div class="comment-form2">
                                                <h4>Rate this movie</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <Rate  @rating-selected="setRating" :rating="userRating" :activeColor="'#FFFF00'" :star-size="30" :animate="true" :maxRating="10" :showRating="false"></Rate>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <h4>{{ ratings.length}} ratings</h4>

                                            <div v-for="rating in ratings" :key="rating.id" class="cmt-item flex-it">
                                                <img :src="'/images/users/'+rating.user.avatar" alt="" style="border-radius: 50%" width="75px">
                                                <div class="author-infor">
                                                    <div class="flex-it2">
                                                        <h6>
                                                            <a :href="'/users/'+rating.user.id">{{ rating.user.username }}</a>
                                                        </h6>
                                                        <span class="time">
                                                            <vue-moments-ago prefix="posted" suffix="ago" :date="rating.created_at"></vue-moments-ago>
                                                        </span>
                                                    </div>
                                                    <div class="rate2">
                                                        <Rate :rating="rating.rating" :readOnly="true" :activeColor="'#FFFF00'" :star-size="10" :animate="false" :maxRating="10" :showRating="false"></Rate>
                                                    </div>
                                                    <p>{{rating.review}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Rate from 'vue-star-rating';
import VueMomentsAgo from 'vue-moments-ago';
export default {
    components: {
        Rate,
        VueMomentsAgo
    },

    data() {
        return {
            comments: '',
            rating: 0,
            ratingNum: '',
            ratings: '',
            stars: '',
            sumComments: '',
            sumWatched: '',
            userRating: 0,
            movieRating: 0,
            actings: '',
        }
    },
    props: {
        isinwatched: {
            type: Boolean,
            required: false
        },
        isinfavorite: {
            type: Boolean,
            required: false
        },
        isincustom: {
            type: Boolean,
            required: false
        },
        isinwatchlist: {
            type: Boolean,
            required: false
        },
        movie: {
            type: Object,
            required: true
        }
    },

    created() {
        axios.get('/responseMovie/'+this.movie.id)
            .then(response => {
                console.log(response.data)
                this.movieRating = response.data.movieRating
                this.comments = response.data.comments
                this.rating = response.data.rating
                this.ratingNum = response.data.ratingNum
                this.ratings = response.data.ratings
                this.sumComments = response.data.sumComments
                this.sumWatched = response.data.sumWatched
                this.userRating = response.data.userRating
                this.stars = response.data.stars
                this.actings = response.data.actings
            })
    },

    methods: {

        setRating(rating) {
            if(!AuthUser){
                return alert("Please log in if u want to leave review!")
            }
            this.userRating = rating;
            axios.post('/addRating/'+this.movie.id+'/'+this.userRating)
                .then(() => {
                axios.get('/responseMovie/'+this.movie.id)
                    .then(response => {
                        this.movieRating = response.data.movieRating
                        this.ratingNum = response.data.ratingNum
                        this.ratings = response.data.ratings
                        this.userRating = response.data.userRating
                    })
            });
        }
    }
}
</script>

<style scoped>

</style>
