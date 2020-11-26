<template>
    <div>
        <form class="user" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
            <h4>Profile details</h4>
            <div class="row">
                <div class="col-md-6 form-it">
                    <label>Username</label>
                    <input type="text" name="username" v-model="form.username" :placeholder="user.username" >
                    <span class="help is-danger" v-if="form.errors.has('username')" v-text="form.errors.get('username')"></span>
                </div>
                <div class="col-md-6 form-it">
                    <label>Email Address</label>
                    <input type="text" :placeholder="user.email" name="email" v-model="form.email">
                    <span class="help is-danger" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-it">
                    <label>First Name</label>
                    <input type="text" :placeholder="user.firstName" name="firstName" v-model="form.firstName">
                    <span class="help is-danger" v-if="form.errors.has('firstName')" v-text="form.errors.get('firstName')"></span>
                </div>
                <div class="col-md-6 form-it">
                    <label>Last Name</label>
                    <input type="text" :placeholder="user.lastName" name="lastName" v-model="form.lastName">
                    <span class="help is-danger" v-if="form.errors.has('lastName')" v-text="form.errors.get('lastName')"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-it">
                    <label>Country</label>
                    <input type="text" :placeholder="user.country" name="country" v-model="form.country">
                    <span class="help is-danger" v-if="form.errors.has('country')" v-text="form.errors.get('country')"></span>
                </div>
                <div class="col-md-6 form-it">
                    <label>City</label>
                    <input type="text" :placeholder="user.city" name="city" v-model="form.city">
                    <span class="help is-danger" v-if="form.errors.has('city')" v-text="form.errors.get('city')"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-it">
                    <label>Description</label>
                    <input type="text" :placeholder="user.description" name="description" v-model="form.description">
                    <span class="help is-danger" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
                </div>
                <div class="col-md-6 form-it">
                    <label>Phone number</label>
                    <input type="text" :placeholder="user.phoneNumber" name="phoneNumber" v-model="form.phoneNumber">
                    <span class="help is-danger" v-if="form.errors.has('phoneNumber')" v-text="form.errors.get('phoneNumber')"></span>
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
                username: '',
                firstName: '',
                lastName: '',
                email: '',
                country: '',
                city: '',
                description: '',
                phoneNumber: '',
            }),
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },

    methods: {
        onSubmit() {
            console.log(this.form)
            this.form.post('/updateDetails/'+this.user.id);
        },
    },

};
</script>

<style scoped>
    .text-success {
        color: green;
    }
</style>
