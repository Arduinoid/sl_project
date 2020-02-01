(function() {
    document.addEventListener('DOMContentLoaded', function() {
        
        var app = new Vue({
            el: '#app',
            data: {
                letters: [],
                people: [],
                duplicatesCalculated: false,
                frequencyCalculated: false,
                showDuplicate: false,
                showLetters: false,
                showModal: false,
                modal: {
                    messages: [
                        'Hello',
                        "I'm a Modal!"
                    ]
                }
            },
            methods: {
                getLetterFrequency,
                destroyCache,
                toggleDuplicates,
                toggleLetterFrequency
            }
        })
        getPeople(app.$data);
    });
    
    async function getLetterFrequency(vm) {
        try {
            var result = await axios.get('people/frequency');
            vm.frequencyCalculated = true;
            vm.letters = result.data;  
        }
        catch (e) {
            vm.modal.messages = [
                'Sorry, we can not calculate letter frequency at this time.',
                'We are experiencing an error'
            ];
            vm.showModal = true;
        }
        // axios.get('people/frequency')
        // .then(function(res) {
        //     vm.frequencyCalculated = true;
        //     vm.letters = res.data;
        // })
        // .catch(function(err) {
        //     vm.modal.messages = [
        //         'Sorry, we can not calculate letter frequency at this time.',
        //         'We are experiencing an error'
        //     ];
        //     vm.showModal = true;
        // });
    }

    function getPossibleDuplicates(vm) {
        axios.get('people/duplicates')
        .then(function(res) {
            vm.duplicatesCalculated = true;
            vm.people = res.data;
        })
        .catch(function(err) {
            vm.modal.messages = [
                'Sorry, we can not get duplicates at this time.',
                'We are experiencing an error'
            ];
            vm.showModal = true;
        });
    }

    function getPeople(data) {
        axios.get('people/get')
        .then(function(res) {
            data.people = res.data;
        });
    }

    function destroyCache() {
        axios.get('people/destroy_cache')
        .then(function(res) {
            alert('Cache has been deleted');
        });
    }

    function toggleDuplicates() {
        var vm = this;
        
        if (!vm.duplicatesCalculated) {
            getPossibleDuplicates(vm);
        }
        vm.showDuplicate = !vm.showDuplicate;
    }

    async function toggleLetterFrequency() {
        var vm = this;

        if (!vm.frequencyCalculated) {
            await getLetterFrequency(vm);
        }

        if (vm.letters.length !== 0) {
            vm.showLetters = !vm.showLetters;
        }
    }

})();