<?php

class pdodb
{

    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;

    public function connect(): PDO
    {
        $config = parse_ini_file("../resources/config.ini");
        $this->servername = $config["sqlServername"];
        $this->username = $config["sqlUsername"];
        $this->password = $config["sqlPassword"];
        $this->dbname = $config["sqlDbname"];
        $this->charset = "utf8mb4";

        try {
            $dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->dbname . ";charset=" . $this->charset . ";";
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "fail: ".$e->getMessage();
        }


    }

}