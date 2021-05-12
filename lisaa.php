<?php

require_once 'inc/headers.php';
require_once 'inc/functions.php';

$input = json_decode(file_get_contents('php://input'));
$name = filter_var($input->name,FILTER_SANITIZE_STRING);
$amount = filter_var($input->amount,FILTER_SANITIZE_NUMBER_INT);

try {
    $db = openDb();
    $lisaa = $db->prepare('INSERT INTO item (name, amount) 
        VALUES (:name, :amount)');
    $lisaa->bindValue(':name',$name,PDO::PARAM_STR);
    $lisaa->bindValue(':amount',$amount,PDO::PARAM_INT);
    $lisaa->execute();

    header('HTTP/1.1 200 OK');

    $data = array('nro' => $db->lastInsertId(), 'name' => $name, 'amount' => $amount);

    echo json_encode($data);

}
catch (PDOException $pdoex) {
    returnError($pdoex);
}