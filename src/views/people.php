<button @click='getPossibleDuplicates' class='button'>Show Possible Duplicates</button>
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
            <tr v-for='person in people' :class='{ highlight: person.isDuplicate}'>
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
        <button @click='getLetterFrequency' class='button'>Get Letter Frequency</button>
        <table v-if='letters.length != 0'>
            <thead>
                <tr>
                    <td>Letter</td>
                    <td>Count</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for='letter in letters'>
                    <td>{{ Object.keys(letter)[0] }}</td>
                    <td>{{ letter[Object.keys(letter)[0]] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>