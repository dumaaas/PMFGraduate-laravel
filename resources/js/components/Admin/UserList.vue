<template>
    <div>
        <div v-show="banMessage" v-text="banMessage.message"></div>
        <table class="table">
            <thead class=" text-primary">
                <th>
                    ID
                </th>
                <th>
                    Name
                </th>
                <th>
                    Username
                </th>
                <th>
                    Email
                </th>
                <th>
                    Country
                </th>
                <th>
                    City
                </th>
                <th>
                    Action
                </th>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <td class="text-primary">
                        {{ user.id }}
                    </td>
                    <td>
                        {{ user.firstName }} {{ user.lastName }}
                    </td>
                    <td>
                        {{ user.username }}
                    </td>
                    <td>
                        {{ user.email }}
                    </td>
                    <td>
                        {{ user.country }}
                    </td>
                    <td>
                        {{ user.city }}
                    </td>
                    <td>
                        <a :href="'/users/'+user.id">
                            <i class="fa fa-user"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" @click.prevent="deleteUser(user.id)">
                            <i class="fa fa-trash"> </i>
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="#" @click.prevent="banUser(user.id)">
                            <i class="fa fa-ban"> </i>
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
            users: '',
            deleteMessage: '',
            banMessage: '',
        }
    },

    mounted() {
        this.getUsers()
    },

    methods: {
        getUsers() {
            axios.get('/users')
                .then(response => {
                    this.users = response.data
                })
        },

        deleteUser(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this movie!",
                icon: "warning",
                buttons: ['Cancel', 'Delete'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                        axios.post('/users/delete/'+id)
                            .then(response => {
                                this.getUsers()
                                this.deleteMessage = response.data
                            })
                    }
                });
        },

        banUser(id) {
            swal({
                title: "Are you sure?",
                text: "If u ban this user, he can't access to site for 7 days!",
                icon: "warning",
                buttons: ['Cancel', 'Ban'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! User has been banned!", {
                            icon: "success",
                        });
                        axios.post('/users/ban/'+id)
                            .then(response => {
                                this.banMessage = response.data
                            })
                    }
                });
        },
    },
}
</script>

<style scoped>

</style>
