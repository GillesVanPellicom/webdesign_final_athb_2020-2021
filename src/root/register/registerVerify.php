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
    <title>Verify</title>
</head>
<body>
<?php
if (isset($_GET['i'])) {

    $error = false;
    $verification = $_GET['i'];

    $query = "SELECT ClientID , ClientVerified FROM client WHERE ClientVerification = '$verification'";
    $qresult = $connection->query($query);

    if ($qresult->num_rows <= 0) {
        $error = true;
    } else {
        $row = $qresult->fetch_assoc();
        if ($row['ClientVerified'] == 1) {
            $error = true;
        } else {
            $clientID = $row['ClientID'];

            $query = "UPDATE client SET ClientVerified = 1 WHERE ClientID = '$clientID'";
            $connection->query($query);
        }
    }



    if ($error) {
        header("Location: ../resources/error/fatalError.html");
    }
} else {
    header("Location: ../resources/error/404.html");
}
?>
<h1>You have been verified!</h1>
<a href="../login/index.php">Press here to go to login</a>
</body>
</html>