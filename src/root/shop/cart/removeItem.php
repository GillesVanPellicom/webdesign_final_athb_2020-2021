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
    <title>Working...</title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">
</head>
<body onload="back()">
<?php
$productId = $_GET['i'];
$clientId = $_SESSION['ClientID'];
$query = "DELETE FROM cart WHERE ClientId = '$clientId' AND ProductId = '$productId'";
$connection->query($query);
?>
<script>
    function back() {
        window.history.back();
    }
</script>
</body>
</html>