<?php

    session_start();
    include "../../config/connection.php";
    if (!isset($_SESSION['user']) || !isset($_SESSION['type'])) {

        header("Location: /public/login.html");
        exit;
    }


    if ($_SESSION['type'] !== 'admin') {
        header("Location: /public/index.php");
        exit;
    }

    