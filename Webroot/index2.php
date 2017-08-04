<?php
session_start();
require '../Config/core.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Rush mvc</title>

</head>

<body>

    <div class="wrapper">
        <header>
            <?= $header; ?>
        </header>
        <main>
            <?= $content; ?>
        </main>

    </div>

</body>
</html>
