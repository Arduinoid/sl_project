document.addEventListener('DOMContentLoaded', function() {
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