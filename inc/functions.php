<?php

function openDb(): object {

    $ini = parse_ini_file("./inc/config.ini", true);

    $servername = $ini['servername'];
    $dbname = $ini['dbname'];
    $username = $ini['username'];
    $password = $ini['password'];

    // $servername = "localhost";
    // $dbname = "kauppalista";
    // $username = "root";
    // $password = "";

    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

function returnError(PDOException $pdoex) {
    echo header('HTTP/1.1 500 Internal Server Error');
    $error = array('error' => $pdoex->getMessage());
    echo json_encode($error);
    exit;
}