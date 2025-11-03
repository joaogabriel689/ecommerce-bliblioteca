<?php
    session_start();

        

    if (!isset($_SESSION['user']) || !isset($_SESSION['type'])) {

        header("Location: login.html");
        exit;
    }


    if ($_SESSION['type'] !== 'admin') {
        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin">nk
    <title>bliblioteca online</title>
</head>
<body>
    <header>
        
            <div>
                <img src="/images/logo-image.png" alt="">
                <h1>bliblioteca online</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="">home</a></li>
                    <li><a href="">livros</a></li>
                    <li><a href=""><i class="fa-solid fa-heart"></i></a></li>
                    <li><a href=""><i class="fa-solid fa-cart-shopping"></i></a></li>
                </ul>
            </nav>
            <button><a href="login.html">login</a></button>
        
    </header>
    
</body>
</html>