<?php

/*
$config = parse_ini_file("../resources/config.ini");
$servername = $config["sqlServername"];
$username = $config["sqlUsername"];
$password = $config["sqlPassword"];
$dbname = $config["sqlDbname"];
*/

$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "webshop";

$connection = new mysqli($servername, $username, $password, $dbname);
$connection->set_charset("utf8mb4");
if ($connection->connect_error) {
    header("Location: ../resources/error/fatalError.html");
    //FIXME send error to console
}