(function() {
    document.addEventListener('DOMContentLoaded', function() {
        
        var app = new Vue({
            el: '#app',
            data: {
                letters: [],
                people: []
            },
            methods: {
                getLetterFrequency,
                getPossibleDuplicates,
            }
        })
        getPeople(app.$data);
    });
    
    function getLetterFrequency() {
        var vm = this;
        axios.get('people/frequency')
        .then(function(res) {
            vm.letters = res.data;
            console.log(res);
        }, function(err) {
            console.log(err);
        });
    }

    function getPossibleDuplicates() {
        var vm = this;
        axios.get('people/duplicates')
        .then(function(res) {
            console.log(res);
            vm.people = res.data;
        }, function(err) {
            console.log(err);
        });
    }

    function getPeople(data) {
        axios.get('people/get')
        .then(function(res) {
            data.people = res.data;
            console.log(res);
        }, function(err) {
            console.log(err);
        });
    }

})();