<template>
    <div>
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Add new movie</h4>
                <p class="card-category">Complete movie informations</p>
            </div>
            <div class="card-body">
                <form @submit.prevent="onSubmit" enctype="multipart/form-data" @keydown="form.errors.clear($event.target.name)">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Movie name</label>
                                <input type="text" class="form-control" name="name" v-model="form.name">
                                <span class="help is-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Genre</label>
                                <input type="text" class="form-control" name="genre" v-model="form.genre">
                                <span class="help is-danger" v-if="form.errors.has('genre')" v-text="form.errors.get('genre')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Release year</label>
                                <input type="text" class="form-control" name="releaseYear" v-model="form.releaseYear">
                                <span class="help is-danger" v-if="form.errors.has('releaseYear')" v-text="form.errors.get('releaseYear')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">iMDB</label>
                                <input type="text" class="form-control" name="imdb" v-model="form.imdb">
                                <span class="help is-danger" v-if="form.errors.has('imdb')" v-text="form.errors.get('imdb')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Duration</label>
                                <input type="text" class="form-control" name="duration" v-model="form.duration">
                                <span class="help is-danger" v-if="form.errors.has('duration')" v-text="form.errors.get('duration')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Trailer</label>
                                <input type="text" class="form-control" name="trailer" v-model="form.trailer">
                                <span class="help is-danger" v-if="form.errors.has('trailer')" v-text="form.errors.get('trailer')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" name="description" v-model="form.description"></textarea>
                                    <span class="help is-danger" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select actors</label><br>
                                <select id="dates-field2" name="actors[]" v-model="form.actors" class="custom-select valid" multiple>
                                    <option v-for="actor in actors" :value="actor.id">{{actor.firstName}} {{actor.lastName}}</option>
                                </select>
                                <span class="help is-danger" v-if="form.errors.has('actors')" v-text="form.errors.get('actors')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <label>Upload movie cover</label>
                            <div class="file-field">
                                <div class="btn btn-primary btn-sm float-left">
                                    <input type="file" name="avatar">
                                    <span class="help is-danger" v-if="form.errors.has('avatar')" v-text="form.errors.get('avatar')"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right" :disabled="form.errors.any()">Add new movie</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

import Form from "../../classes/Form";
import swal from "sweetalert";
export default {
    props: {
        actors: '',
    },

    data() {
        return {
            form: new Form( {
               name: '',
               genre: '',
               releaseYear: '',
               duration: '',
               imdb: '',
               trailer: '',
               description: '',
               actors: [],
            }),
        }
    },

    methods: {
        onSubmit() {
            this.form.post('/addMovie')
                .then(() => {
                        if(!this.form.errors.any()) {
                            swal("Good job!", "You added new movie!", "success");
                        }
                })
        }
    }
}
</script>

<style scoped>
    .text-success {
        color: green;
    }

    .is-danger {
        color: red;
    }
</style>
