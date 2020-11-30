<template>
    <div>
        <div class="comment-form">
            <h4>Leave a comment</h4>
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <textarea name="content" v-model="newComment" placeholder="Comment"></textarea>
                    </div>
                </div>
                <input @click.prevent="addComment" class="submit" type="submit" value="submit">
            </form>
        </div>
        <h4>{{ commentCount}} comments</h4>
        <comment v-for="comment in comments.data" :comment="comment" :key="comment.id" :movie="movie"></comment>
        <div class="text-center">
            <input v-if="comments.next_page_url" @click="fetchComments" class="button" type="submit" value="Load more">
            <input v-else class="button" type="submit" value="No more comments to show :)">
        </div>
    </div>
</template>

<script>
import Comment from "./Comment";
export default {
    props: {
        movie: '',
    },

    components: {
        Comment
    },

    mounted() {
        this.fetchComments()
    },

    data() {
        return {
            comments: {
                data: []
            },
            newComment: '',
            commentCount: this.movie.commentCount
        }
    },



    methods: {
        fetchComments() {
            const url = this.comments.next_page_url ? this.comments.next_page_url : '/movies/'+this.movie.id+'/comments'
            axios.get(url)
                .then(({data}) => {
                    this.comments = {
                        ...data,
                        data: [
                            ...this.comments.data,
                            ...data.data
                        ]
                    }
                })
        },

        addComment() {
            if(! this.newComment) return
            axios.post('/addComment/'+this.movie.id, {
                content: this.newComment
            }).then(({data}) => {
                this.comments = {
                    ...this.comments,
                    data: [
                        data,
                        ...this.comments.data
                    ]
                }
                this.commentCount++
                this.newComment = ''
            })
        }
    }
}
</script>

<style scoped>
    .button {
        margin-top: 10px;
        background-color: #dd003f;
        padding: 0 45px;
        height: 46px;
        -webkit-border-radius: 30px;
        -moz-border-radius: 30px;
        border-radius: 30px;
        font-family: 'Dosis', sans-serif;
        font-size: 14px;
        color: #ffffff;
        font-weight: bold;
        text-transform: uppercase;
        border: none;
    }
</style>
