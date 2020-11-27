<template>
    <div>
        <form @submit.prevent="onSubmit">
            <input type="date" name="date" v-model="date">
            <div v-show="message">
                <p class="text-success" v-text="message.message"></p>
            </div>
            <div class="btn-transform transform-vertical red">
                <br>
                <input type="submit" class="redbtn" value="Set reminder">
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        movie: {
            type: Object,
            required: true,
        }
    },

    data() {
        return {
            message: '',
            date: '',
        }
    },

    methods: {
        onSubmit() {
            if(!AuthUser) {
                return alert('Please login to set reminder!')
            }
            axios.post('/setReminder/'+this.movie.id+'/'+this.date)
                .then(response => {
                    this.message = response.data
                })
                .catch(function (error) {
                    const response = error.response
                    console.log(response.data.errors)
                })
        }
    }
}
</script>

<style scoped>
    .text-success {
        color: green;
    }
</style>
