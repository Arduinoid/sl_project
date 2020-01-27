<div class="container">
    <h1 class='hero'><?= $message ?></h1>
    <div class="navbar">
        <?php foreach($links as $link) { ?>
            <a href=<?= $link['href'] ?>><?= $link['text'] ?></a>
        <?php } ?>
    </div>
</div>