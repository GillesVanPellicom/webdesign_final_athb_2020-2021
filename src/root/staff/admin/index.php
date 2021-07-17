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
    <title>Admin - Homepage</title>
    <link rel="stylesheet" type="text/css" href="/include/default.css">
    <?php
    if ($_SESSION['ClientIsStaff'] == 0) {
        header("Location: /resources/error/404.html");
    }
    ?>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav.php";
?>
<div id="container" class="admin">
    <h1 class="adminerror">You can only view this page on PC</h1>
    <h1>Admin dashboard</h1>
    <a href="category"><u>Edit categories - Click</u></a><br>
    <a href="brand"><u>Edit brands - Click</u></a><br>
    <a href="product"><u>Edit products - Click</u></a>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/footer/main.html";
$connection->close();
?>
</body>
</html>