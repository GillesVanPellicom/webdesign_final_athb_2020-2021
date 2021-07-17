<?php
if (isset($_SESSION['ClientID'])) {
    include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav_loggedIn.php";
} else {
    include $_SERVER['DOCUMENT_ROOT'] . "/include/nav/nav_loggedOut.php";
}
?>
