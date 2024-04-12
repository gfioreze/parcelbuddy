class Ajax {
    constructor() {
        this.xhr = new XMLHttpRequest();
    }

    get(endpoint, callback) {
        this.xhr.open('GET', endpoint, true);
        this.xhr.onload = () => {
            if (this.xhr.status === 200) {
                callback(null, this.xhr.responseText);
            } else {
                callback('Error:' + this.xhr.status);
            }
        }
        this.xhr.send();
    }

    post(endpoint, data, callback) {
        this.xhr.open('POST', endpoint, true);
        this.xhr.setRequestHeader('Content-type', 'application/json');
        this.xhr.onload = () => {
            if (this.xhr.status === 200 || this.xhr.status === 201) {
                callback(null, this.xhr.responseText);
            } else {
                callback('Error:' + this.xhr.status);
            }
        }
        const jsonData = JSON.stringify(data);
        this.xhr.send(jsonData);
    }
}