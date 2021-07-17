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
    <title>
        <?php

        if (isset($_GET['i'])) {
            $verification = $_GET['i'];
            $query = "SELECT ClientID FROM client WHERE ClientVerification = '$verification'";

            $qresult = $connection->query($query);

            if ($qresult->num_rows == 1) {
                $ClientId = $connection->query($query)->fetch_assoc()['ClientID'];
            } else {
                header("Location: /resources/error/404.html");
            }
        }

        if ($langId == 1) {
            echo "Wachtwoord vergeten";
        } else if ($langId == 2) {
            echo "Forgot password";
        } else if ($langId == 3) {
            echo "Mot de passe oublié:";
        }
        ?>
    </title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">

</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";
?>
<div id="container" class="text-center">
    <h1>        <?php
        if ($langId == 1) {
            echo "Wachtwoord vergeten";
        } else if ($langId == 2) {
            echo "Forgot password";
        } else if ($langId == 3) {
            echo "Mot de passe oublié:";
        }
        ?></h1>
    <div class="formdiv text-center">
        <form method="POST" action="resethandler.php">
            <div class="text-left">
                <?php
                if ($langId == 1) {
                    echo "Nieuw wachtwoord:";
                } else if ($langId == 2) {
                    echo "New password:";
                } else if ($langId == 3) {
                    echo "Nouveau mot de passe:";
                }
                ?>
            </div>
            <input type="password" class="form-input" name="passw" id="passw">
            <input type="text" class="form-input" name="cid" id="cid" style="display: none;" value="<?= $ClientId?>">

            <input type="submit" value="<?php
            if ($langId == 1) {
                echo "Verstuur";
            } else if ($langId == 2) {
                echo "Send";
            } else if ($langId == 3) {
                echo "Envoyer";
            }
            ?>" class="button" name="submitt" id="submitt">
        </form>
    </div>
</div>
<?php



include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>