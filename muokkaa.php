<?php

require_once 'inc/headers.php';
require_once 'inc/functions.php';

$input = json_decode(file_get_contents('php://input'));
$nro = filter_var($input->nro, FILTER_SANITIZE_NUMBER_INT);
$name = filter_var($input->name,FILTER_SANITIZE_STRING);
$amount = filter_var($input->amount,FILTER_SANITIZE_NUMBER_INT);

try {
    $db = openDb();
    $muokkaa = $db->prepare('UPDATE item SET name = :name, amount = :amount WHERE nro = :nro');
    $muokkaa->bindValue(':nro', $nro, PDO::PARAM_INT);
    $muokkaa->bindValue(':name',$name,PDO::PARAM_STR);
    $muokkaa->bindValue(':amount',$amount,PDO::PARAM_INT);
    $muokkaa->execute();

    header('HTTP/1.1 200 OK');

    $data = array('nro' => $nro, 'name' => $name, 'amount' => $amount);

    echo json_encode($data);

}
catch (PDOException $pdoex) {
    returnError($pdoex);
}