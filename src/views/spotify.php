<div>
    <h1 class='hero'><?= $message ?></h1>
    <ul>
        <?php foreach($albums as $album) { ?>
            <li><?= $album ?></li>
        <?php } ?>
    </ul>
</div>