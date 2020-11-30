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
                    <span class="time"> {{  comment.created_at }}</span>
                </div>
                <p>{{ comment.content }}</p>
<!--                <p><a href="{{route('likeable.comment', ['comment' => $comment->id, 'type' => 'up'])}}"><i class="{{$comment->isCommentLiked($comment->id) ? 'blue fa fa-thumbs-up' : 'fa fa-thumbs-up'}}"></i></a>     <a href="{{route('likeable.comment', ['comment' => $comment->id, 'type' => 'down'])}}"><i class="{{!$comment->isCommentLiked($comment->id) ? 'blue fa fa-thumbs-down' : 'fa fa-thumbs-down'}}"></i></a>  </p>-->
            </div>
        </div>
    </div>
</template>

<script>

export default {
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
}
</script>

<style scoped>

</style>
