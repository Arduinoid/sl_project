<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <?php if (DEVENV != true) { ?>
    <script src="/js/vue.js"></script>
    <?php } else { ?>
    <script src="/js/vue_dev.js"></script>
    <?php } ?>
    <script src="/js/axios.min.js"></script>
    <script src="/js/app.js"></script>
    <title><?= $pageTitle ?? 'People' ?></title>
</head>
<body>
    <div id="app" class='container'>
        <?= $_view ?>
    </div>
</body>
</html>