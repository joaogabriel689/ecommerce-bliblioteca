<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <div>
            <img src="/images/logo-image.png" alt="">
            <h1>bliblioteca online</h1>
        </div>
        <button><a href="painel_controle.html"><i class="fa-solid fa-user"></i></a></button>
    </header>
    <?php
        echo "<h1>Ola {$_SESSION['name']}</h1>";
    ?>
    <section id="area-user">
        <ul>
            <li><div class="function-user">
                <i class="fa-solid fa-truck"></i><h2><a href=""></a></h2>
            </div></li>
            <li><div class="function-user">
                <i class="fa-regular fa-heart"></i><h2><a href=""></a></h2>
            </div></li>
            <li><div class="function-user">
                <i class="fa-solid fa-location-dot"></i><h2><a href=""></a></h2>
            </div></li>
            <li><div class="function-user">
                <i class="fa-solid fa-credit-card"></i><h2><a href=""></a></h2>
            </div></li>
            <li><div class="function-user">
                <i></i><h2><a href=""></a></h2>
            </div></li>
            <li><div class="function-user">
                <i></i><h2><a href=""></a></h2>
            </div></li>
            <li><div class="function-user">
                <i></i><h2><a href=""></a></h2>
            </div></li>
            <li><div class="function-user">
                <i></i><h2><a href=""></a></h2>
            </div></li>
            <li><div class="function-user">
                <i></i><h2><a href=""></a></h2>
            </div></li>
            <li><div class="function-user">
                <i></i><h2><a href=""></a></h2>
            </div></li>
            <li><div class="function-user">
                <i></i><h2><a href=""></a></h2>
            </div></li>
            <li><div class="function-user">
                <i></i><h2><a href=""></a></h2>
            </div></li>
        </ul>
    </section>

</body>
</html>