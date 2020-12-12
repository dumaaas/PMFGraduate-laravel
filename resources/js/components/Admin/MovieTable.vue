<template>
    <div>
        <table class="table">
            <thead class=" text-primary">
                <th>
                    ID
                </th>
                <th>
                    Name
                </th>
                <th>
                    Genre
                </th>
                <th>
                    imDB
                </th>
                <th>
                    Year
                </th>
                <th>
                    Duration
                </th>
                <th>
                    Action
                </th>
            </thead>
            <tbody>
                <tr v-for="movie in movies" ref="deleteMovie">
                    <td class="text-primary">
                        {{ movie.id}}
                    </td>
                    <td>
                        {{ movie.name }}
                    </td>
                    <td>
                        {{ movie.genre }}
                    </td>
                    <td>
                        {{ movie.imdb }}/10
                    </td>
                    <td>
                        {{ movie.releaseYear }}
                    </td>
                    <td>
                        {{ movie.duration }} min
                    </td>
                    <td>
                        <a :href="'/movies/'+movie.id">
                            <i class="fa fa-film"></i>
                        </a>&nbsp;&nbsp;
                        <a :href="'/editMovie/'+movie.id">
                            <i class="fa fa-edit"></i>
                        </a>&nbsp;&nbsp;
                        <a href="#" @click.prevent="deleteMovie(movie.id)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import swal from 'sweetalert';

export default {
    data() {
        return {
            movies: '',
            message: '',
        }
    },

    mounted() {
        this.getMovies();
    },

    methods: {
        getMovies() {
            axios.get('/getMoviesAdmin')
                .then(response => {
                    this.movies = response.data
                })
        },

        deleteMovie(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this movie!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Movie has been deleted!", {
                            icon: "success",
                        });
                        axios.post('/movies/delete/'+id)
                            .then(response => {
                                this.getMovies()
                                this.message = response.data
                            })
                    }
                });
        },
    },
}
</script>

<style scoped>

</style>
