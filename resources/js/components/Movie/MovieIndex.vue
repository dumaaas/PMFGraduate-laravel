<template>
    <div>
        <div class="page-single movie_list">
            <div class="container">
                <div class="row ipad-width2">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <form>
                            <div class="topbar-filter">
                                <p>Found <span>{{ movies.length }}</span> movies in total</p>
                                <label>Sort by:</label>
                                <select name='sort' @change="onChange($event)" v-model="key">
                                    <option disabled selected value=""> -- select an option -- </option>
                                    <option value="newest">From newest</option>
                                    <option value="oldest">From oldest</option>
                                </select>
                            </div>
                        </form>
                        <div v-for="movie in movies" :key="movie.id" class="movie-item-style-2">
                            <img :src="'/images/movies/'+movie.avatar" alt="" width="60px">
                            <div class="mv-item-infor">
                                <h6>
                                    <a :href="'/movies/'+movie.id">{{ movie.name}}
                                    <span>
                                        {{ movie.releaseYear }}
                                    </span>
                                    </a>
                                </h6>
                                <p class="rate"><i class="ion-android-star"></i><span>{{ movie.imdb }}</span> /10</p>
                                <p class="describe">{{ movie.description }}</p>
                                <p class="run-time"> Duration: {{ movie.duration }} min</p>
                                <p>Director: <a href="#">Joss Dumnic</a></p>
                                <p class="run-time"> Genre: {{ movie.genre }}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="sidebar">
                            <div class="celebrities">
                                <h4 v-if="auth" class="form-style-1 sb-title">
                                    You watched
                                    <span>{{ watchedcount }}/{{ moviestotal }} ({{ percent }}%)</span>
                                </h4>
                            </div>
                            <div class="search-form">
                                <h4 class="sb-title">Search for movie</h4>
                                <form @submit.prevent="searchMovies" class="form-style-1">
                                    <div class="row">
                                        <div class="col-md-12 form-it">
                                            <label>Movie name</label>
                                            <input v-model="keyword" name="keyword" type="text" placeholder="Enter keywords">
                                        </div>
                                        <div class="col-md-12 form-it">
                                            <label>Genres</label>
                                            <div>
                                                <select v-model="genre" name="genre">
                                                    <option disabled selected value=""> -- select an option -- </option>
                                                    <option value="Action">Action</option>
                                                    <option value="Adventure">Adventure</option>
                                                    <option value="Comedy">Comedy</option>
                                                    <option value="Crime">Crime</option>
                                                    <option value="Drama">Drama</option>
                                                    <option value="Fantasy">Fantasy</option>
                                                    <option value="Historical">Historical</option>
                                                    <option value="Horror">Horror</option>
                                                    <option value="Mystery">Mystery</option>
                                                    <option value="Sci-Fi">Sci-Fi</option>
                                                    <option value="Romance">Romance</option>
                                                    <option value="Thriller">Thriller</option>
                                                    <option value="Western">Western</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-it">
                                            <label>Rating Range</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input v-model="from" name="from" type="text" placeholder="From">
                                                </div>
                                                <div class="col-md-6">
                                                    <input v-model="to" name="to" type="text" placeholder="To">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-it">
                                            <label>Release Year</label>
                                            <input v-model="year" name="year" type="text" placeholder="Enter release year">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: {
        moviestotal: '',
        watchedcount: '',
        percent: ''
    },

    data() {
        return {
            key: '',
            movies: [],
            keyword: '',
            genre: '',
            year: '',
            to: '',
            from: '',

        }
    },

    computed: {
        auth() {
            return AuthUser
        }
    },

    watch: {
        keyword:function (val) {
            this.searchMovies();
        },
        year:function (val) {
            this.searchMovies();
        },
        from:function (val) {
            this.searchMovies();
        },
        to:function(val) {
            this.searchMovies();
        },
        genre:function (val) {
            this.searchMovies();
        }
    },

    mounted() {
        axios.get('/getMovies/')
            .then(response => {
                this.movies = response.data
            })
    },

    methods: {
        onChange(event) {
            axios.get('/sortMovies/'+event.target.value)
                .then(response => {
                    this.movies = response.data
                })
        },

        searchMovies() {
            axios.get('/searchMovies/', {
                params: {
                    keyword: this.keyword,
                    genre: this.genre,
                    to: this.to,
                    from: this.from,
                    year: this.year,
                }
            })
                .then(response => {
                    this.movies = response.data
                })
                .catch(function(error) {
                    const response = error.response
                    console.log(response.data.errors)
                })

        }
    }
}
</script>

<style scoped>

</style>
