<div>
    <h1 class='hero'><?= $message ?></h1>
    <div class="navbar">
        <?php foreach($links as $link) { ?>
            <a href=<?= $link['href'] ?>><?= $link['text'] ?></a>
        <?php } ?>
    </div>
    <button @click='destroyCache' class='button'>Destroy Cache</button>
</div>