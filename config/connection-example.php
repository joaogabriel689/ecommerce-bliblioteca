<?php
include '../class/connectionclass.php';
$db_name = 'CHANGE ME';
$db_host = 'CHANGE ME';
$db_user = 'CHANGE ME';
$db_pass = 'CHANGE ME';

$pdo = new connection_bd($db_name, $db_host, $db_user, $db_pass);
$connection = $pdo->getPdo();
