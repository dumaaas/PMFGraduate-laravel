<template>
    <div>
        <table class="table">
            <thead class=" text-primary">
                <th>
                    ID
                </th>
                <th>
                    Movie
                </th>
                <th>
                    User
                </th>
                <th>
                    Rating
                </th>
                <th>
                    Created date
                </th>
                <th>
                    Action
                </th>
            </thead>
            <tbody>
                <tr v-for="rating in ratings">
                    <td>
                        {{ rating.id }}
                    </td>
                    <td class="text-primary">
                        <a :href="'/movies/'+rating.movie.id"> {{ rating.movie.name }} </a>
                    </td>
                    <td>
                        <a :href="'/users/'+rating.user.id"> {{ rating.user.username }} </a>
                    </td>
                    <td>
                        <i class="fa fa-star"></i> {{ rating.rating }}/10
                    </td>
                    <td>
                        {{ moment(rating.created_at).format('MMMM Do YYYY, h:mm:ss a') }}
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" @click.prevent="deleteRating(rating.movie.id, rating.user.id)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import swal from "sweetalert";
import moment from "moment";
export default {
    data() {
        return {
            ratings: '',
            message: ''
        }
    },

    mounted() {
        this.getRatings()
    },

    methods: {
        getRatings() {
            axios.get('/getRatings')
                .then(response => {
                    this.ratings = response.data
                })
        },

        deleteRating(movieId, userId) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this ratings!",
                icon: "warning",
                buttons: ['Cancel', 'Delete'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Rating has been deleted!", {
                            icon: "success",
                        });
                        axios.post('/ratings/delete/'+movieId+'/'+userId)
                            .then(response => {
                                this.getRatings()
                                this.message = response.data
                            })
                    }
                });

        }
    }
}
</script>

<style scoped>

</style>
