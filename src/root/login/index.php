<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/init.php";
include $_SERVER['DOCUMENT_ROOT'] . "/include/recaptcha/script.php";
include $_SERVER['DOCUMENT_ROOT'] . "/include/recaptcha/verifier.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">
    <style>

    </style>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";
$emailError = "";
$passwordError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['recaptcha_response'])) {


    if ($recaptcha->score >= 0.5) {
        $error = false;

        $email = sanitizeString($_POST["email"]);
        $password = sanitizeString($_POST["password"]);

        if (empty($email)) {
            if ($langId == 1) {
                $emailError = "<br>Voer uw email in.";
            } else if ($langId == 2) {
                $emailError = "<br>Enter your email.";
            } else if ($langId == 3) {
                $emailError = "<br>Enter your email.";
            }
            $error = true;

        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($langId == 1) {
                $emailError = "<br>Dit account bestaat niet. Het email en/of het wachtwoord is fout.";
            } else if ($langId == 2) {
                $emailError = "<br>This account does not exist. The email and/or password are wrong";
            } else if ($langId == 3) {
                $emailError = "<br>This account does not exist. Either the email or password are wrong";
            }
            $error = true;
        } else {
            //Check if email occurs in db
            $query = "SELECT ClientVerified FROM client WHERE ClientMail = '$email'";
            $qresult = $connection->query($query);

            if (mysqli_num_rows($qresult) >= 1) {
                //Check if account is verified
                $row = $qresult->fetch_assoc();
                if ($row['ClientVerified'] != 1) {
                    if ($langId == 1) {
                        $emailError = "<br>Dit account is niet geverifieerd.";
                    } else if ($langId == 2) {
                        $emailError = "<br>This account is not verified.";
                    } else if ($langId == 3) {
                        $emailError = "<br>This account is not verified.";
                    }
                    $error = true;
                }

            } else {
                if ($langId == 1) {
                    $emailError = "<br>Dit account bestaat niet. Het email en/of het wachtwoord is fout.";
                } else if ($langId == 2) {
                    $emailError = "<br>This account does not exist. The email and/or password are wrong";
                } else if ($langId == 3) {
                    $emailError = "<br>This account does not exist. Either the email or password are wrong";
                }
                $error = true;
            }
        }


        if (empty($password)) {
            if ($langId == 1) {
                $passwordError = "<br>Voer uw wachtwoord in.";

            } else if ($langId == 2) {
                $passwordError = "<br>Enter your password.";

            } else if ($langId == 3) {
                $passwordError = "<br>Enter your password .";
            }
            $error = true;
        } else if ($emailError == "") {
            $query = "SELECT ClientPassword, ClientID, ClientName, ClientFirstName, ClientIsStaff FROM client WHERE ClientMail = '$email'";
            $row = $connection->query($query)->fetch_assoc();
            if (!password_verify($password, $row['ClientPassword'])) {
                if ($langId == 1) {
                    $emailError = "<br>Dit account bestaat niet. Het email en/of het wachtwoord is fout.";
                } else if ($langId == 2) {
                    $emailError = "<br>This account does not exist. The email and/or password are wrong";
                } else if ($langId == 3) {
                    $emailError = "<br>This account does not exist. Either the email or password are wrong";
                }
                $error = true;
            }
        }
        if (!$error) {
            $_SESSION['ClientID'] = $row['ClientID'];
            $_SESSION['ClientFirstName'] = $row['ClientFirstName'];
            $_SESSION['ClientIsStaff'] = $row['ClientIsStaff'];

            header("Location: /shop/");
        }
    }
}

?>
<div id="container">
<div class="text-center formdiv">
    <form id="register" method="POST" novalidate>

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
        <input type="text" name="email" class="form-input" value="<?php
        if (isset($_POST["email"])) {
            echo $_POST["email"];
        }
        ?>">
        <div class="error text-left"><?= $emailError ?></div>
        <br>
        <div class="text-left">
            <?php
            if ($langId == 1) {
                echo "Wachtwoord:";
            } else if ($langId == 2) {
                echo "Password:";
            } else if ($langId == 3) {
                echo "Mot de passe:";
            }
            ?> </div>
        <input type="password" class="form-input" name="password" value="<?php
        if (isset($_POST["password"])) {
            echo $_POST["password"];
        }
        ?>">
        <div class="error text-left"><?= $passwordError ?></div>
        <br>

        <button type="submit" class="button is-link">
            <?php
            if ($langId == 1) {
                echo "Doorgaan";
            } else if ($langId == 2) {
                echo "Continue";
            } else if ($langId == 3) {
                echo "Continuer";
            }
            ?></button>

        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </form>
    <p style="text-align: center"> <?php
        if ($langId == 1) {
            echo "<a href='/register'>Heeft u nog geen account? <u><strong>Klik hier.</strong></u></a> ";
        } else if ($langId == 2) {
            echo "<a href='/register'>Do you not have an account yet? <u><strong>Click here.</strong></u></a>";
        } else if ($langId == 3) {
            echo "<a href='/register'>Vous n'avez pas encore de compte? <u><strong>Cliquez ici.</strong></u></a>";
        }
        echo "<br>";
        if ($langId == 1) {
            echo "<a href='/forgot/'>Uw wachtwoord vergeten? <u><strong>Klik hier.</strong></u></a> ";
        } else if ($langId == 2) {
            echo "<a href='/forgot/'>Forgot your password? <u><strong>Click here.</strong></u></a>";
        } else if ($langId == 3) {
            echo "<a href='/forgot/'>Mot de passe oublié? <u><strong>Cliquez ici.</strong></u></a>";
        }

        ?></p>
</div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>