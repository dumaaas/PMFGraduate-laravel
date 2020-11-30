<template>
    <div>
        <div class="cmt-item flex-it">
            <img :src="'/images/users/'+comment.user.avatar" alt=""
                 style="border-radius: 50%" width="75px">
            <div class="author-infor">
                <div class="flex-it2">
                    <h6>
                        <a :href="'/users/'+comment.user.id">{{ comment.user.username }}</a>
                    </h6>
                    <span class="time">
                        <vue-moments-ago prefix="posted" suffix="ago" :date="comment.created_at"></vue-moments-ago>
                    </span>
                </div>
                <p>{{ comment.content }}</p>
                <div class="row">
                    <div class="col-md-8 form-it">
                     <votes :default_votes="comment.likes" :entity_id="comment.id" :entity_owner="comment.user.id"></votes>
                    </div>
                    <div class="floatRight">
                        <button @click="addingReply = !addingReply"  class="button">
                            {{addingReply ? 'Cancel' : 'Add Reply'}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="comment-form reply-form">
            <form  v-if="addingReply">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text"  name="content" v-model="content" placeholder="Type reply...">
                   </div>
                    <div class="col-md-2">
                        <button @click.prevent="addReply">Reply</button>
                    </div>
                </div>
            </form>
        </div>
        <replies ref="replies" :comment="comment"></replies>
    </div>
</template>

<script>
import Replies from "./Replies";
import Votes from "./Votes";
import VueMomentsAgo from 'vue-moments-ago';
export default {

    components: {
        Votes,
        Replies,
        VueMomentsAgo
    },

    props: {
        comment: {
            required: true,
            default: () => ({})
        },
        movie: {
            required: true,
            default: () => ({})
        }
    },

    data() {
        return {
            addingReply: false,
            content: ''
        }
    },

    methods: {
        addReply() {
            if(!this.content) return
            axios.post('/addComment/'+this.movie.id, {
                comment_id: this.comment.id,
                content: this.content
            }).then(({data}) => {
                this.content = ''
                this.addingReply = false
                this.$refs.replies.addReply(data)
            })
        }
    }
}
</script>

<style scoped>
    .button {
        margin-top: 10px;
        background-color: #dd003f;
        padding: 0 20px;
        height: 30px;
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

    .floatRight {
        float: right;
        margin-top: 0;
        margin-left: 400px;
    }

    .reply-form form button {
        padding-top: 12.5px;
        padding-bottom: 12.5px;
        padding-left: 20px;
        padding-right: 20px;
        background-color: #dd003f;
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

    .reply-form {
        margin-top: 20px;
    }

</style>
