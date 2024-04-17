/*
The Ajax class facilitates asynchronous communication with the server using XMLHttpRequest by encapsulating
HTTP operations (GET and POST requests), providing a simple interface for making AJAX calls.
*/

class Ajax {
    // The constructor creates an instance of the XMLHttpRequest
    constructor() {
        this.xhr = new XMLHttpRequest();
    }
    // The get() method sends a GET request to the specified endpoint
    // and invokes the callback function upon completion
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

    // The post() method sends a POST request to the specified endpoint with the
    // provided data and calls the callback function when the request completes
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