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
    <title>Document</title>
</head>
<body onload="back()">
<?php
$langid = $_SESSION['lang'];
session_unset();
$_SESSION['lang'] = $langid;
?>
<script>
    function back() {
        window.history.back();
    }
</script>
</body>
</html>
