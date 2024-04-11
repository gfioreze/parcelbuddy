class Ajax {
    constructor() {
        this.xhr = new XMLHttpRequest();
    }

    get(url, callback) {
        this.xhr.open('GET', '../get.php', true);
        this.xhr.onload =  function() {

        }
    }
}