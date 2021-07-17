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
        <form action="handler.php" method="POST">
            <div class="text-left">
                <?php
                if ($langId == 1) {
                    echo "E-Mail:";
                } else if ($langId == 2) {
                    echo "E-Mail:";
                } else if ($langId == 3) {
                    echo "Courriel:";
                }
                ?>
            </div>
            <input type="text" class="form-input" name="mail" id="mail">
            <input type="submit" value="<?php
            if ($langId == 1) {
                echo "Verstuur";
            } else if ($langId == 2) {
                echo "Send";
            } else if ($langId == 3) {
                echo "Envoyer";
            }
            ?>" class="button">
        </form>
    </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>