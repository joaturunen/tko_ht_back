<?php

require_once 'inc/headers.php';
require_once 'inc/functions.php';

$input = json_decode(file_get_contents('php://input'));
$nro = filter_var($input->nro, FILTER_SANITIZE_NUMBER_INT);

try {
    $db = openDb();
    $poista = $db->prepare('DELETE FROM item WHERE nro = :nro');
    $poista->bindValue(':nro', $nro, PDO::PARAM_INT);
    $poista->execute();

    header('HTTP/1.1 200 OK');

    $data = array('nro' => $nro);

    echo json_encode($data);

}
catch (PDOException $pdoex) {
    returnError($pdoex);
}