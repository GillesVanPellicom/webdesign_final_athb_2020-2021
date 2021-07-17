<?php
session_start();

//Importing basic tools
include $_SERVER['DOCUMENT_ROOT'] . "/include/database.php";
include $_SERVER['DOCUMENT_ROOT'] . "/include/utils/sanitize.php";

//Set language if modal is missed.
if (!isset($_SESSION['lang'])){
    $_SESSION['lang'] = 2;
}


$langId = $_SESSION['lang'];