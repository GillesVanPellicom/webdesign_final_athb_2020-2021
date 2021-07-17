<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/init.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">

</head>
<body>
<div id="container">
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";
        ?>
        <h1 class="text-center" style="margin-top: 2%"><?php
            if ($langId == 1) {
                echo "U bent geregistreerd!";
            } else if ($langId == 2) {
                echo "You have been registered!";
            } else if ($langId == 3) {
                echo "Vous avez été enregistré!";
            }
            ?></h1>
        <div class="text-center"><?php
            if ($langId == 1) {
                echo "Er is een verificatiemail verstuurd naar uw inbox.";
            } else if ($langId == 2) {
                echo "A verification mail has been sent to your inbox.";
            } else if ($langId == 3) {
                echo "Un message de vérification a été envoyé dans votre boîte de réception.";
            }
            ?></div>
    </div>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
    $connection->close();
    ?>
</body>
</html>