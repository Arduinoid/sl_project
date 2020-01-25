<table></table>

<table>
<thead>
    <tr>
        <td>Name</td>
        <td>Email</td>
        <td>Title</td>
    </tr>
</thead>
<tbody>
<?php foreach($people as $person): ?>
    <tr>
        <td><?= $person->display_name ?></td>
        <td><?= $person->email_address ?></td>
        <td><?= $person->title ?></td>
    </tr>
<?php endforeach ?>
</tbody>
</table>