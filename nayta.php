<?php

require_once 'inc/headers.php';
require_once 'inc/functions.php';

try {
    $db = openDb();
    $sql = "SELECT * FROM item";
    $nayta = $db->query($sql);
    $result = $nayta->fetchAll(pdo::FETCH_ASSOC);

    header('HTTP/1.1 200 OK');

    echo json_encode($result);

}
catch (PDOException $pdoex) {
    returnError($pdoex);
}
