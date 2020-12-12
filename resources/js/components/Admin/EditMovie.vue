<template>
    <div>
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Edit movie</h4>
                <p class="card-category">Complete movie informations</p>
            </div>
            <div class="card-body">
                <form @submit.prevent="onSubmit" enctype="multipart/form-data" @keydown="form.errors.clear($event.target.name)">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Movie name</label>
                                <input type="text" class="form-control" name="name" v-model="form.name" :placeholder="movie.name">
                                <span class="help is-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Genre</label>
                                <input type="text" class="form-control" name="genre" v-model="form.genre" :placeholder="movie.genre">
                                <span class="help is-danger" v-if="form.errors.has('genre')" v-text="form.errors.get('genre')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Release year</label>
                                <input type="text" class="form-control" name="releaseYear" v-model="form.releaseYear" :placeholder="movie.releaseYear">
                                <span class="help is-danger" v-if="form.errors.has('releaseYear')" v-text="form.errors.get('releaseYear')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">iMDB</label>
                                <input type="text" class="form-control" name="imdb" v-model="form.imdb" :placeholder="movie.imdb">
                                <span class="help is-danger" v-if="form.errors.has('imdb')" v-text="form.errors.get('imdb')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Duration</label>
                                <input type="text" class="form-control" name="duration" v-model="form.duration" :placeholder="movie.duration">
                                <span class="help is-danger" v-if="form.errors.has('duration')" v-text="form.errors.get('duration')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Trailer</label>
                                <input type="text" class="form-control" name="trailer" v-model="form.trailer" :placeholder="movie.duration">
                                <span class="help is-danger" v-if="form.errors.has('trailer')" v-text="form.errors.get('trailer')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" name="description" v-model="form.description" :placeholder="movie.description"></textarea>
                                    <span class="help is-danger" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
                                </div>
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
                    <button type="submit" class="btn btn-primary pull-right" :disabled="form.errors.any()">Edit movie</button>
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
        movie: '',
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
            }),
        }
    },

    methods: {
        onSubmit() {
            this.form.put('/movies/editMovie/'+this.movie.id)
                .then(() => {
                    if(!this.form.errors.any()) {
                        swal("Good job!", "You edited this movie!", "success");
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
