<?php


// echo  json_encode($trace);
// die;


?>


<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">

    <title><?= lang('Errors.whoops') ?></title>

    <style>
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
    </style>
</head>

<body>

    <div class="container text-center">

        <?php var_dump(nl2br(esc($exception->getMessage())));
        // var_dump($trace);
        echo  json_encode($trace);
        // var_dump($title);
        // var_dump($exception->getCode());
        die; ?>

        <h1 class="headline"><?= lang('Errors.whoops') ?></h1>

        <p class="lead"><?= lang('Errors.weHitASnag') ?></p>

    </div>

</body>

</html>