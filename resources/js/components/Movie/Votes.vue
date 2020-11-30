<template>
    <div>
        <!--<p><a href="{{route('likeable.comment', ['comment' => $comment->id, 'type' => 'up'])}}"><i class="{{$comment->isCommentLiked($comment->id) ? 'blue fa fa-thumbs-up' : 'fa fa-thumbs-up'}}"></i></a>     <a href="{{route('likeable.comment', ['comment' => $comment->id, 'type' => 'down'])}}"><i class="{{!$comment->isCommentLiked($comment->id) ? 'blue fa fa-thumbs-down' : 'fa fa-thumbs-down'}}"></i></a>  </p>-->

        <a @click="vote('up')">
            <i class="fa fa-thumbs-up thumbs-up" :class="{'thumbs-up-active': upvoted}"></i> {{upvotes_count}}
        </a>
        <a @click="vote('down')">
            <i class="fa fa-thumbs-down thumbs-down" :class="{'thumbs-down-active': downvoted}"></i> {{downvotes_count}}
        </a>
    </div>
</template>

<script>
import numeral from 'numeral'
export default {
    props: {
        default_votes: {
            required: true,
            default: () => []
        },
        entity_owner: {
            required: true,
            default: ''
        },
        entity_id: {
            required: true,
            default: ''
        }
    },

    data() {
        return {
            votes: this.default_votes
        }
    },

    computed: {
        upvotes() {
            return this.votes.filter(v => v.liked === 'up')
        },

        downvotes() {
            return this.votes.filter(v => v.liked === 'down')
        },
        upvotes_count() {
            return numeral(this.upvotes.length).format('0a')
        },
        downvotes_count() {
            return numeral(this.downvotes.length).format('0a')
        },
        upvoted() {
            if(! AuthUser) return false
            return !!this.upvotes.find(v => v.user_id === AuthUser.id)
        },
        downvoted() {
            if(! AuthUser) return false
            return !!this.downvotes.find(v => v.user_id === AuthUser.id)
        }

    },
    methods: {
        vote(type) {
            if(!AuthUser) {
                return alert('Please login to vote!')
            }
            if(type==='up' && this.upvoted) return
            if(type==='down' && this.downvoted) return

            axios.post('/likeComment/'+this.entity_id+'/'+type)
                .then(({data}) => {
                    if(this.upvoted || this.downvoted) {
                        this.votes = this.votes.map(v => {
                            if(v.user_id === AuthUser.id) {
                                return data
                            }
                            return v
                        })
                    } else {
                        this.votes = [
                            ...this.votes,
                            data
                        ]
                    }
                })
        }
    }
}
</script>

<style>

.thumbs-up, .thumbs-down {
    width: 20px;
    height: 20px;
    cursor: pointer;
    color: #666666;
}
.thumbs-down-active, .thumbs-up-active {
    color: #3EA6FF
}
.thumbs-down {
    margin-left: 1rem;
}
</style>

