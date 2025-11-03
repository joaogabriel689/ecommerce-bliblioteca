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
    <link rel="stylesheet" href="style/admin">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="shortcut icon" href="images/logo-image.ico" type="image/x-icon">
    <link rel="stylesheet" href="/style/style.css">
    <title>bliblioteca online</title>
</head>
<body>
    <header>
        
            <div>
                <img src="/images/logo-image.png" alt="">
                <h1>bliblioteca online</h1>
            </div>

        
    </header>
    <div class="container">
        <?php
            echo "<h1>Ola, {$_SESSION['name']}</h1>";
        ?>
        <section id="area-user">
            <ul>
                <li><div class="function-user">
                    <a href="order.php"><i class="fa-solid fa-truck"></i><h2>Pedidos</h2></a>
                </div></li>
                <li><div class="function-user">
                    <a href="favorites.php"><i class="fa-regular fa-heart"></i><h2>Favoritos</h2></a>
                </div></li>
                <li><div class="function-user">
                    <a href="adress.php"><i class="fa-solid fa-location-dot"></i><h2>Enderços</h2></a>
                </div></li>
                <li><div class="function-user">
                    <a href="pay-form.php"><i class="fa-solid fa-credit-card"></i><h2>Formas de Pagamento</h2></a>
                </div></li>
                <li><div class="function-user">
                    <a href="settings.php"><i class="fa-solid fa-gear"></i><h2>Configuraçoes</h2></a>
                </div></li>
                <li><div class="function-user">
                    <a href="users.php"><i class="fa-solid fa-users"></i></i><h2>Usuarios</h2></a>
                </div></li>
                <li><div class="function-user">
                    <a href="books.php"><i class="fa-solid fa-book-open"></i><h2>Catalogo de Livros</h2></a>
                </div></li>
                <li><div class="function-user">
                    <a href="sales.php"><i class="fa-solid fa-money-bill-trend-up"></i><h2>Vendas</h2></a>
                </div></li>
                <li><div class="function-user">
                    <a href="exit.php"><i class="fa-solid fa-right-from-bracket"></i><h2>Sair</h2></a>
                </div></li>
            </ul>
        </section>
    </div>

    <footer>
        <section id="social-media">
            <a href="https://www.instagram.com/joao_pereira_couto/"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://github.com/joaogabriel689link"><i class="fa-brands fa-github"></i></a>
            <a href="https://www.linkedin.com/in/joao-couto-b55b04321/"><i class="fa-brands fa-linkedin"></i></a>

        </section>
        <p>&copy; 2024 Biblioteca Online. Todos os direitos reservados.</p>

    </footer>
    
</body>
</html>