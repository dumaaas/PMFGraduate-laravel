<template>
    <div>
        <div>
            <div v-if="hideReplies">
                <div v-for="(reply, key) in replies.data" :key="key">
                    <div class="cmt-item flex-it">
                        <img :src="'/images/users/'+reply.user.avatar" alt=""
                             style="border-radius: 50%" width="75px">
                        <div class="author-infor">
                            <div class="flex-it2">
                                <h6>
                                    <a :href="'/users/'+reply.user.id">{{ reply.user.username }}</a>
                                </h6>
                                <span class="time">
                                    <vue-moments-ago prefix="posted" suffix="ago" :date="reply.created_at"></vue-moments-ago>
                                </span>
                            </div>
                            <p>{{ reply.content }}</p>
                            <div class="row">
                                <div class="col-md-8 form-it">
                                    <votes :default_votes="reply.likes" :entity_id="reply.id" :entity_owner="reply.user.id"></votes>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="key+1 != replies.data.length" class="line"></div>
                </div>
                <div class="text-center">
                    <input @click="hide" class="button" type="submit" value="Hide replies">
                </div>
            </div>
            <div v-if="!hideReplies && repliesCount > 0" class="text-center">
                <input @click="fetchReplies" class="button" type="submit" :value="'Load replies ('+repliesCount+')'">
            </div>
        </div>
    </div>
</template>
<script>
import Votes from "./Votes";
import VueMomentsAgo from 'vue-moments-ago';
export default {
    props: ['comment'],

    components: {
        Votes, VueMomentsAgo
    },

    data() {
        return {
            replies: {
                data: [],
            },
            repliesCount: this.comment.repliesCount,
            hideReplies: false
        }
    },

    methods: {
        fetchReplies() {
            const url = '/comments/'+this.comment.id+'/replies'
            axios.get(url)
                .then(({data}) => {
                    this.replies = {
                        ...data,
                        data: [
                            ...this.replies.data,
                            ...data.data
                        ]
                    }
                    this.hideReplies = true
                    this.$emit('showReplies', true)
                })
        },
        addReply(reply) {
            this.replies = {
                ...this.replies,
                data: [
                    reply,
                    ...this.replies.data
                ]
            }
            this.hideReplies = true
            this.repliesCount++
        },
        hide() {
            this.replies.data = ''
            this.hideReplies= false
            this.$emit('showReplies', false)
        }
    }
}
</script>

<style scoped>
    .cmt-item {
        margin-left: 60px;
    }

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

    .line {
        margin-left: 70px;
        Float:left;
        height:30px;
        border-left:1px solid  red;
    }
</style>
