<template>
    <div>
        <table class="table">
            <thead class="text-primary">
                <th>
                    Movie
                </th>
                <th>
                    Author
                </th>
                <th>
                    Text
                </th>
                <th>
                    Created date
                </th>
                <th>
                    Action
                </th>
            </thead>
            <tbody>
                <tr v-for="comment in comments">
                    <td>
                        <a :href="'/movies/'+comment.commentable_id">
                            {{ comment.commentable_id }}
                        </a>
                    </td>
                    <td>
                        <a :href="'/users/'+comment.user.id">
                            {{ comment.user.username }}
                        </a>
                    </td>
                    <td>
                        {{ comment.content.substring(0,20)+"..." }}
                    </td>
                    <td>
                        {{ moment(comment.created_at).format('MMMM Do YYYY, h:mm:ss a') }}
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" @click.prevent="deleteComment(comment.id)">
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
            comments: '',
            message: ''
        }
    },

    mounted() {
        this.getComments()
    },

    methods: {
        getComments() {
            axios.get('getComments')
                .then(response => {
                    this.comments = response.data
                })
        },

        deleteComment(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this comment!",
                icon: "warning",
                buttons: ['Cancel', 'Delete'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Comment has been deleted!", {
                            icon: "success",
                        });
                        axios.post('/comments/delete/'+id)
                            .then(response => {
                                this.getComments()
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
