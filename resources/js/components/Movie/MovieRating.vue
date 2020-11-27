<template>
    <Rate  @rating-selected="setRating" :rating="rating" :activeColor="'#FFFF00'" :star-size="30" :animate="true" :maxRating="10" :showRating="false"></Rate>
</template>

<script>
import Rate from 'vue-star-rating';
export default {
    components: {
        Rate
    },

    props: {
        rating: '',
        movie: ''
    },

    data() {
        return {
            newRating: this.rating
        }
    },

    methods: {
        setRating(rating) {
            this.newRating = rating;
            axios.post('/addRating/'+this.movie.id+'/'+this.newRating)
                .then(response => this.newRating = rating);
        }
    }
}
</script>

<style scoped>

</style>
