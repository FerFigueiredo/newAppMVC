<?php

include './src/Controller/ConnDB.php';
use Alura\Cursos\Controller\ConnDB;

$conn = new ConnDB();

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);

    die;
}

$empresas = $conn->fetch_one('SELECT id, sigla FROM empresa WHERE id in (1, 17, 18, 19, 736)');
echo 'fetch_one';
var_dump($empresas);

$empresas = $conn->fetch_all('SELECT id, sigla FROM empresa WHERE id in (1, 17, 18, 19, 736)');
echo 'fetch_all';
var_dump($empresas);
