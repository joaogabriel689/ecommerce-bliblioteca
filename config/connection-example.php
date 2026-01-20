<?php
include 'connectionclass.php';
$db_name = 'changes_here';
$db_host = 'changes_here';
$db_user = 'changes_here';
$db_pass = 'changes_here';

$pdo = new connection_bd($db_name, $db_host, $db_user, $db_pass);
$connection = $pdo->getPdo();
