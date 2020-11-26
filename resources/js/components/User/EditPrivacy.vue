<template>
    <div>
        <form class="user">
            <h4>Privacy</h4>
            <div v-if="user.privacy=='public'">
                <input type="radio" name="privateOrPublic" @change="onChange($event)" value="public" checked>
                <label>Public profile</label>
                <div class="custom-control custom-radio">
                    <input type="radio" name="privateOrPublic" @change="onChange($event)" value="private">
                    <label>Private profile</label>
                </div>
            </div>
            <div v-else>
                <input type="radio" name="privateOrPublic" @change="onChange($event)" value="public">
                <label>Public profile</label>
                <div class="custom-control custom-radio">
                    <input type="radio" name="privateOrPublic" @change="onChange($event)" value="private" checked>
                    <label>Private profile</label>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-it" v-show="form.message">
                    <p class="text-success" v-text="form.message"></p>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            form: new Form({

            }),
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },

    methods: {
        onChange(event) {
            var data = event.target.value;
            this.form.post('/privateProfile/'+this.user.id+'/'+event.target.value);
        }
    },

};
</script>

<style scoped>
    .text-success {
        color: green;
    }
</style>
