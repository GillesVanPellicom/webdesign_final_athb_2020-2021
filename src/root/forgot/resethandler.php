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
if (isset($_POST['submitt'])) {
    $ClientId = $_POST['cid'];
    $pass = $_POST['passw'];
    $pass = password_hash($pass, PASSWORD_BCRYPT);
    $query = "UPDATE client SET ClientPassword = '$pass' WHERE ClientID = '$ClientId'";
    $connection->query($query);
}
?>
<div id="container" class="text-center">
    <?php
    echo "<h1 class='text-center' style='margin-top: 3%'>";
    if ($langId == 1) {
        echo "Uw wachtwoord is opnieuw ingesteld.";
    } else if ($langId == 2) {
        echo "Your password has been reset.";
    } else if ($langId == 3) {
        echo "Votre mot de passe a été réinitialisé.";
    }
    echo "</h1>
<form action='/login/' class='inline'>
<div class='text-center' style='margin-top: 1%'>
<button class='submit-button button' >

    ";
    if ($langId == 1) {
        echo "Inloggen";
    } else if ($langId == 2) {
        echo "Log in";
    } else if ($langId == 3) {
        echo "Connectez-vous";
    }
    echo "</button></div>
</form>";
        ?>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>