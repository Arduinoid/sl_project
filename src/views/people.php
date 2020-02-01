<button @click='toggleDuplicates' class='button'>Show Possible Duplicates</button>
<div class="columns">
    <div class="column is-three-quarters">
        <table v-if='people.length != 0'>
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Title</td>
            </tr>
        </thead>
        <tbody>
            <tr v-for='(person, index) in people' :class='{ highlight: (showDuplicate && person.isDuplicate), grey: index % 2 !== 0 }'>
                <td>{{ person.display_name }}</td>
                <td>{{ person.email_address }}</td>
                <td>{{ person.title }}</td>
            </tr>
        </tbody>
        </table>
        <div v-else>
            <img src="/images/loading.gif" alt="loading animation">
        </div>
    </div>
    <div class="column">
        <button @click='toggleLetterFrequency' class='button'>Get Letter Frequency</button>
        <table v-if='letters.length != 0 && showLetters'>
            <thead>
                <tr>
                    <td>Letter</td>
                    <td>Count</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for='(letter, index) in letters' :class='{ grey: index % 2 !== 0 }'>
                    <td>{{ Object.keys(letter)[0] }}</td>
                    <td>{{ letter[Object.keys(letter)[0]] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div id="modal" v-if='showModal'>
    <div class="box">
        <div class="modal-message" v-for='message in modal.messages'>{{ message }}</div>
        <div class="actions">
            <button @click='showModal=false' class='button'>OK</button>
        </div>
    </div>
</div>