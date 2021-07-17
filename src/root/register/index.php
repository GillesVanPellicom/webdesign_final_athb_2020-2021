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
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">

</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";

$firstNameError = "";
$lastNameError = "";
$emailError = "";
$phoneError = "";
$passwordOneError = "";
$passwordTwoError = "";
$dateError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['recaptcha_response'])) {
    //Formvalidation

    $error = false;

    $firstName = sanitizeString($_POST["firstName"]);
    $lastName = sanitizeString($_POST["lastName"]);
    $email = sanitizeString($_POST["email"]);
    $phone = sanitizeString($_POST["phone"]);
    $passwordOne = sanitizeString($_POST["passwordOne"]);
    $passwordTwo = sanitizeString($_POST["passwordTwo"]);
    $dateYear = sanitizeString($_POST["year"]);
    $dateMonth = sanitizeString($_POST["month"]);
    $dateDay = sanitizeString($_POST["day"]);
    if (isset($_POST["newsletter"])) {
        $newsLetter = sanitizeString($_POST["newsletter"]);
        if ($newsLetter == 'true') {
            $newsLetter = 1;
        } else {
            $newsLetter = 0;
        }
    } else {
        $newsLetter = 0;
    }


    if (empty($firstName)) {
        if ($langId == 1) {
            $firstNameError = "<br>Voer uw voornaam in.";
        } else if ($langId == 2) {
            $firstNameError = "<br>Enter your first name.";
        } else if ($langId == 3) {
            $firstNameError = "<br>Enter your first name.";
        }
        $error = true;
    }
    if (empty($lastName)) {
        if ($langId == 1) {
            $lastNameError = "<br>Voer uw naam in.";
        } else if ($langId == 2) {
            $lastNameError = "<br>Enter your name.";
        } else if ($langId == 3) {
            $lastNameError = "<br>Enter your last name.";
        }
        $error = true;
    }
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
            $emailError = "<br>Voer een geldige email in.";
        } else if ($langId == 2) {
            $emailError = "<br>Enter a valid email.";
        } else if ($langId == 3) {
            $emailError = "<br>Enter a valid email.";
        }
        $error = true;

    } else {
        $emailFound = false;
        $query = "SELECT ClientMail FROM client";
        $qresult = $connection->query($query);
        while ($row = $qresult->fetch_assoc()) {
            if ($row["ClientMail"] == $email) {
                $emailFound = true;
                break;
            }
        }
        if ($emailFound) {
            if ($langId == 1) {
                $emailError = "<br>Deze email is al in gebruik.";

            } else if ($langId == 2) {
                $emailError = "<br>This email is already in use.";

            } else if ($langId == 3) {
                $emailError = "<br>This email is already in use.";
            }
            $error = true;
        }
    }
    if (empty($phone)) {
        if ($langId == 1) {
            $phoneError = "<br>Voer uw telefoonnummer in.";
        } else if ($langId == 2) {
            $phoneError = "<br>Enter your phone number.";
        } else if ($langId == 3) {
            $phoneError = "<br>Enter your phone number.";
        }

        $error = true;
    }
    if (empty($passwordOne)) {
        if ($langId == 1) {
            $passwordOneError = "<br>Voer uw wachtwoord in.";
        } else if ($langId == 2) {
            $passwordOneError = "<br>Enter your password.";
        } else if ($langId == 3) {
            $passwordOneError = "<br>Enter your password";
        }
        $error = true;
    }
    if (empty($passwordTwo)) {
        if ($langId == 1) {
            $passwordTwoError = "<br>Herhaal uw wachtwoord.";
        } else if ($langId == 2) {
            $passwordTwoError = "<br>Repeat your password.";
        } else if ($langId == 3) {
            $passwordTwoError = "<br>Repeat your password";
        }
        $error = true;
    } else if ($passwordOne != $passwordTwo) {
        if ($langId == 1) {
            $passwordTwoError = "<br>Uw wachtwoorden komen niet overeen.";
        } else if ($langId == 2) {
            $passwordTwoError = "<br>Your passwords don't match.";
        } else if ($langId == 3) {
            $passwordTwoError = "<br>Your passwords don't match.";
        }
        $error = true;
    }
    if (!checkdate($dateMonth, $dateDay, $dateYear)) {
        if ($langId == 1) {
            $dateError = "<br>Deze datum is ongeldig.";

        } else if ($langId == 2) {
            $dateError = "<br>This date is invalid.";

        } else if ($langId == 3) {
            $dateError = "<br>This date is invalid";

        }$error = true;
    }
    if (!$error) {

        if ($recaptcha->score >= 0.5) {

            $passwordOne = password_hash($passwordOne, PASSWORD_BCRYPT);

            try {
                $hash = bin2hex(random_bytes(50));
            } catch (Exception $e) {
                //FIXME send error to console
            }

            //Place client into DB
            $query = "INSERT INTO client (
                    ClientName, ClientFirstName, ClientBirthDate, ClientMail, 
                    ClientPhone, ClientNewsLetter, LanguageId, TitleId, ClientPassword, ClientVerification) 
                    VALUES (
                            '$lastName', '$firstName', STR_TO_DATE('$dateDay-$dateMonth-$dateYear', '%d-%m-%Y'),
                            '$email', '$phone', '$newsLetter', 3, 1,'$passwordOne', '$hash');";
            $connection->query($query);

            $query = "SELECT ClientVerification FROM client WHERE ClientName = '$lastName' AND ClientFirstName = '$firstName' AND ClientMail = '$email'";
            $qresult = $connection->query($query);
            $row = $qresult->fetch_assoc();

            $verification = $row['ClientVerification'];

            $header = "From: noreply.webshop@telenet.be\r";
            $regLink = "http://localhost/register/registerverify.php?i=" . $verification;
            if ($langId == 1) {
                $subject = "Bevestiging registratie Superset";
            } else if ($langId == 2) {
                $subject = "Confirmation registration Superset";
            } else if ($langId == 3) {
                $subject = "Confirmation de l'enregistrement Superset";
            }

            if ($langId == 1) {
                $msg = "Verzonden op " . date("d-m-Y") . " om " . date("H:i") . "\n" .
                    "Druk op de link hieronder om te verifiëren.\n".
                    $regLink;
            } else if ($langId == 2) {
                $msg = "Sent on " . date("d-m-Y") . " at " . date("H:i") . "\n" .
                    "Press the link below to verify\n".
                    $regLink;
            } else if ($langId == 3) {
                $msg = "Envoye le " . date("d-m-Y") . " a " . date("H:i") . "\n" .
                    "Cliquez sur le lien ci-dessous pour verifier.\n".
                    $regLink;
            }


            ini_set("SMTP", "smtp.telenet.be");
            mail($email, $subject, $msg, $header);

            header("Location: ./registerOk.php");

        } else {
            header("Location: /resources/error/fatalError.html");
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
                    echo "Voornaam";
                } else if ($langId == 2) {
                    echo "First name";
                } else if ($langId == 3) {
                    echo "Prénom";
                }
                ?>
            </div>

            <input class="form-input" type="text" name="firstName" id="firstName" value="<?php
            if (isset($_POST["firstName"])) {
                echo $_POST["firstName"];
            }
            ?>">
            <div class="error text-left"><?= $firstNameError ?></div>
            <br>

            <div class="text-left"><?php
                if ($langId == 1) {
                    echo "Naam";
                } else if ($langId == 2) {
                    echo "Name";
                } else if ($langId == 3) {
                    echo "Nom";
                }
                ?></div>

            <input class="form-input" type="text" name="lastName" value="<?php
            if (isset($_POST["lastName"])) {
                echo $_POST["lastName"];
            }
            ?>">
            <div class="error text-left"><?= $lastNameError ?></div>
            <br>

            <div class="text-left"><?php
                if ($langId == 1) {
                    echo "E-Mail";
                } else if ($langId == 2) {
                    echo "E-Mail";
                } else if ($langId == 3) {
                    echo "Courriel";
                }
                ?></div>

            <input class="form-input" type="text" name="email" value="<?php
            if (isset($_POST["email"])) {
                echo $_POST["email"];
            }
            ?>">
            <div class="error text-left"><?= $emailError ?></div>
            <br>

            <div class="text-left"><?php
                if ($langId == 1) {
                    echo "Telefoonnummer";
                } else if ($langId == 2) {
                    echo "Phone number";
                } else if ($langId == 3) {
                    echo "Numéro de téléphone";
                }
                ?></div>
            <input class="form-input" type="text" name="phone" id="phone" value="<?php
            if (isset($_POST["phone"])) {
                echo $_POST["phone"];
            }
            ?>">
            <div class="error text-left"><?= $phoneError ?></div>
            <br>

            <div class="text-left"><?php
                if ($langId == 1) {
                    echo "Wachtwoord";
                } else if ($langId == 2) {
                    echo "Password";
                } else if ($langId == 3) {
                    echo "Mot de passe";
                }
                ?></div>
            <input class="form-input" type="password" name="passwordOne" id="passwordOne" value="<?php
            if (isset($_POST["passwordOne"])) {
                echo $_POST["passwordOne"];
            }
            ?>">
            <div class="error text-left"><?= $passwordOneError ?></div>
            <br>

            <div class="text-left"><?php
                if ($langId == 1) {
                    echo "Herhaal wachtwoord";
                } else if ($langId == 2) {
                    echo "Repeat password";
                } else if ($langId == 3) {
                    echo "Répéter mot de passe";
                }
                ?></div>

            <input class="form-input" type="password" name="passwordTwo" value="<?php
            if (isset($_POST["passwordTwo"])) {
                echo $_POST["passwordTwo"];
            }
            ?>">
            <div class="error text-left"><?= $passwordTwoError ?></div>
            <br>

            <div class="text-left"><?php
                if ($langId == 1) {
                    echo "Geboortedatum";
                } else if ($langId == 2) {
                    echo "Date of birth";
                } else if ($langId == 3) {
                    echo "Date de naissance";
                }
                ?></div>
            <input class="form-input" type="number" name="day" id="day" value="<?php
            if (isset($_POST['day'])) {
                echo $_POST['day'];
            } else {
                echo '1';
            }
            ?>">
            <select name="month" class="form-input">
                <?php
                if ($langId == 1) {
                    echo "
            <option value='1'>Januari</option>
            <option value='2'>Februari</option>
            <option value='3'>Maart</option>
            <option value='4'>April</option>
            <option value='5'>Mei</option>
            <option value='6'>Juni</option>
            <option value='7'>Juli</option>
            <option value='8'>Augustus</option>
            <option value='9'>September</option>
            <option value='10'>October</option>
            <option value='11'>November</option>
            <option value='12'>December</option>
                ";
                } else if ($langId == 2) {
                    echo "
            <option value='1'>January</option>
            <option value='2'>February</option>
            <option value='3'>March</option>
            <option value='4'>April</option>
            <option value='5'>May</option>
            <option value='6'>June</option>
            <option value='7'>July</option>
            <option value='8'>August</option>
            <option value='9'>September</option>
            <option value='10'>October</option>
            <option value='11'>November</option>
            <option value='12'>December</option>
                ";
                } else if ($langId == 3) {
                    echo "
            <option value='1'>Janvier </option>
            <option value='2'>Février </option>
            <option value='3'>Mars</option>
            <option value='4'>Avril</option>
            <option value='5'>Mai</option>
            <option value='6'>Juin</option>
            <option value='7'>Juillet</option>
            <option value='8'>Août</option>
            <option value='9'>Septembre</option>
            <option value='10'>Octobre</option>
            <option value='11'>Novembre</option>
            <option value='12'>Decembre</option>
                ";
                }
                ?>

            </select>


            <input class="form-input" type="number" name="year" value="<?php
            if (isset($_POST['year'])) {
                echo $_POST['year'];
            } else {
                echo '2000';
            }
            ?>">
            <div class="error text-left"><?= $dateError ?></div>
            <br>

            <div class="text-center"><?php
                if ($langId == 1) {
                    echo "Abonneer op onze nieuwsbrief";
                } else if ($langId == 2) {
                    echo "Subscribe to our newsletter";
                } else if ($langId == 3) {
                    echo "Abonnez-vous à notre lettre d'information";
                }
                ?></div>
            <input class="text-left" type="checkbox" name="newsletter" value="true"<?php
            if (isset($_POST['newsletter'])) {
                echo 'checked=\"true\"';
            }
            ?>><br><br>


            <button type="submit" class="button is-link"><?php
                if ($langId == 1) {
                    echo "Registreer";
                } else if ($langId == 2) {
                    echo "Register";
                } else if ($langId == 3) {
                    echo "Enregistrez";
                }
                ?></button>

            <input class="form-input" type="hidden" name="recaptcha_response" id="recaptchaResponse">
        </form>
    </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>