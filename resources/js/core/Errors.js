class Errors {
    constructor() {
        this.errors = {};
    }

    any() {
        return Object.keys(this.errors).length > 0;
    }

    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    record(errors) {
        if (!_.isEmpty(this.errors)) {
            return this.errors = _.merge(this.errors, errors);
        }
        return this.errors = errors;
    }

    clear(field) {
        if (field) {
            delete this.errors[field];
            return;
        }
        this.errors = {};
    }
}

export default Errors;
