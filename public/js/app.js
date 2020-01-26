document.addEventListener('DOMContentLoaded', function() {
    axios.get('/duplicates')
    .then(function(res) {
        console.log(res);
    }, function(err) {
        console.log(err);
    });
    axios.get('/frequency')
    .then(function(res) {
        console.log(res);
    }, function(err) {
        console.log(err);
    });
    var app = new Vue({
        el: '#app'
    })
});