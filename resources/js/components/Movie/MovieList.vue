<template>
    <div>
        <a href="#" v-if="isAdded" @click.prevent="remove()" class="parent-btn">
            <i class="fa fa-heart"></i>
            Remove from {{ type }}
        </a>
        <a href="#" v-else @click.prevent="add()" class="parent-btn">
            <i class="fa fa-heart-o"></i>
            Add to {{ type }}
        </a>
    </div>

</template>

<script>
export default {
    props: {
        type: {
            type: String,
            required: true
        },
        movie: {
            type: Object,
            required: true
        },
        isinmovielist: {
            type: Boolean,
            required: true
        }
    },

    data() {
        return {
            isAdded: '',
        }
    },

    mounted() {
        this.isAdded = this.isinmovielist ? true: false;
    },

    computed: {
        isInMovieList() {
            return this.isinmovielist;
        }
    },

    methods: {
        add() {
            if(!AuthUser) {
                return alert('Please login to add movie in '+this.type+'!')
            }
            axios.post('/addToList/'+this.movie.id+'/'+this.type)
                .then(response => this.isAdded = true)
                .catch(response => console.log(response.data));
        },

        remove() {
            axios.post('/removeFromList/'+this.movie.id+'/'+this.type)
                .then(response => this.isAdded = false)
                .catch(response => console.log(response.data));
        }
    }
}
</script>

<style scoped>

</style>
