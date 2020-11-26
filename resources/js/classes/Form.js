import Errors from './Errors.js';

class Form {

    constructor(data) {
        this.originalData = data;

        for(let field in data) {
            this[field] = data[field];
        }
        this.message = "";
        this.errors = new Errors();
    }

    data() {
        let data = {};
        for(let property in this.originalData) {
            data[property] = this[property];
            //linija iznad je ekvivalenta
            // data.name = this.name
            // data.description = this.description
        }
        //drugi nacin za sve iznad
        // let data = Object.assign({}, this);
        // delete data.originalData;
        // delete data.errors;
        return data;
    }

    reset() {
        for(let field in this.originalData) {
            this[field] = '';
        }

        this.errors.clear();
    }

    has(field) {
        return this.message.hasOwnProperty(field);
    }

    post(url) {
        return this.submit('post', url);
    }

    get(url) {
        return this.submit('get', url);
    }

    delete(url) {
        return this.submit('delete', url);
    }

    put(url) {
        return this.submit('put', url);
    }

    submit(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                    this.onSuccess(response.data);
                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data);
                    reject(error.response.data);
                });
        })

    }

    onSuccess(data) {
        this.message = data.message;
        this.reset();
    }

    onFail(errors) {
        this.message = '';
        this.errors.record(errors);
    }
}

export default Form;
