<?php

include("../config/connectionclass.php");
require 'vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$dbName = $_ENV['DB_NAME'];
$dbHost = $_ENV['DB_HOST'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];

$conection = new connection_bd($dbName, $dbHost, $dbUser, $dbPass);
$pdo = $conection->getPdo();

