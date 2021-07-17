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

if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];
    $query = "SELECT ClientID FROM client WHERE ClientMail = '$mail'";
    $qresult = $connection->query($query);

    if ($qresult->num_rows == 1) {
        $ClientID = $qresult->fetch_assoc()['ClientID'];

        try {
            $hash = bin2hex(random_bytes(50));
        } catch (Exception $e) {
        }
        $query = "UPDATE client SET ClientVerification = '$hash' WHERE ClientID = '$ClientID'";
        $connection->query($query);

        $query = "SELECT ClientVerification FROM client WHERE ClientID = '$ClientID'";
        $verification = $connection->query($query)->fetch_assoc()['ClientVerification'];

        ini_set("SMTP", "smtp.telenet.be");
        $header = "From: noreply.webshop@telenet.be\r";
        $regLink = "http://localhost/forgot/reset.php?i=" . $verification;
        if ($langId == 1) {
            $subject = "Herstel wachtwoord Superset";
        } else if ($langId == 2) {
            $subject = "Recovery password Superset";
        } else if ($langId == 3) {
            $subject = "Récupération du mot de passe Superset";
        }

        if ($langId == 1) {
            $msg = "Verzonden op " . date("d-m-Y") . " om " . date("H:i") . "\n" .
                "Druk op de link hieronder om te herstellen.\n".
                $regLink;
        } else if ($langId == 2) {
            $msg = "Sent on " . date("d-m-Y") . " at " . date("H:i") . "\n" .
                "Press the link below to recover\n".
                $regLink;
        } else if ($langId == 3) {
            $msg = "Envoye le " . date("d-m-Y") . " a " . date("H:i") . "\n" .
                "Cliquez sur le lien ci-dessous pour récupérer.\n".
                $regLink;
        }


        ini_set("SMTP", "smtp.telenet.be");
        mail($mail, $subject, $msg, $header);
    }
}

?>
<div id="container" class="text-center">
    <h1>        <?php
        if ($langId == 1) {
            echo "Reset instructies zijn naar de door u opgegeven mail verstuurd.";
        } else if ($langId == 2) {
            echo "Reset instructions have been sent to the mail you have entered.";
        } else if ($langId == 3) {
            echo "Les instructions de réinitialisation ont été envoyées à l'adresse électronique que vous avez indiquée.";
        }
        ?></h1>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>