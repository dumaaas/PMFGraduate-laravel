<template>
    <div>
        <form class="password" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
            <input type="hidden" name="_token" :value="csrf">

            <h4>Change password</h4>
            <div class="row">

                <span class="col-md-6 form-it">
                    <label>Old Password</label>
                    <input type="password" placeholder="**********" name="oldPassword" v-model="form.oldPassword"/>
                    <span class="help is-danger" v-if="form.errors.has('oldPassword')" v-text="form.errors.get('oldPassword')"></span>
                </span>
            </div>
            <div class="row">
                <div class="col-md-6 form-it">
                    <label>New Password</label>
                    <input type="password" placeholder="***************" name="newPassword" v-model="form.newPassword">
                    <span class="help is-danger" v-if="form.errors.has('newPassword')" v-text="form.errors.get('newPassword')"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-it">
                    <label>Confirm New Password</label>
                    <input type="password" placeholder="*************** " name="confirmPassword" v-model="form.confirmPassword">
                    <span class="help is-danger" v-if="form.errors.has('confirmPassword')" v-text="form.errors.get('confirmPassword')"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-it" v-show="form.message">
                    <p class="text-success" v-text="form.message"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <input class="submit" type="submit" :disabled="form.errors.any()" value="Update">
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
                oldPassword: '',
                newPassword: '',
                confirmPassword: ''
            }),
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },

    methods: {
        onSubmit() {
            console.log(this.form)
            this.form.post('/updatePassword/'+this.user.id);
        },
    },

};
</script>

<style scoped>

    .text-success {
        color: green;
    }

</style>
