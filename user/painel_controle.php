<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: ../public/login.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="shortcut icon" href="images/logo-image.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style/base.css">
    <link rel="stylesheet" href="../style/user.css">
    <link rel="stylesheet" href="../style/index.css">
    <script src="../script/script.js"></script>
    <title>painel de controle</title>
</head>
<body>
     <header>
        
            <div>
                <a href="index.php">
                    <img src="../images/logo-image.png" alt="">
                    <h1>bliblioteca online</h1>
                </a>
            </div>
            <nav id="desktop-menu">
                <ul>
                    <li><a href="../public/index.php">home</a></li>
                    <li><a href="../public/catalog-books.php">livros</a></li>
                    <li><a href="../public/favorites.php"><i class="fa-solid fa-heart"></i></a></li>
                    <li><a href="../public/orders.php"><i class="fa-solid fa-cart-shopping"></a></i></li>

                </ul>
                <div class="orders">
                    <?php
                    $total = 0;
                    foreach($_SESSION['orders'] as $product){
                        $total = $total +  ($product['value'] * $product['qtd'])
                        ?>
                        <div class="product-order " >
                            <h3><?= $product['name'] ?></h3>
                            <p>R$ <?= $product['value'] ?></p>
                            <p>Subtotal: R$ <?php $product['value'] * $product['qtd']?></p>

                        </div>

                    <?php
                    }
                    ?>
                        <div class="total-order">
                            <form action="" method="post">
                                <label for=""><?php $total ?></label>
                                <input type="submit" value="comprar">
                            </form>
                                
                        </div>
                    <?php

                    ?>
                </div>
            </nav>
            <button id="mobile-menu-button"><i class="fa-solid fa-book-atlas"></i></button>
            <nav id="mobile-menu">
                <?php
            if (empty($_SESSION['email'])){
                echo '<li><button><a href="../public/login.html">login</a></button></li>';
            }else{
                if ($_SESSION['type'] == 'admin'){
                    echo '<li><button><a href="../admin/admin.php"><i class="fa-solid fa-address-book"></i></a></button></li>';
                }else{
                    echo '<li><button><a href="../user/painel_controle.php"><i class="fa-solid fa-address-book"></i></a></button></li>';
                }  
            }
            ?>
                    <li><a href="../public/index.php">home</a></li>
                    <li><a href="../public/catalog-books.php">livros</a></li>
                    <li><a href="../public/favorites.php"><i class="fa-solid fa-heart"></i></a></li>
                    <li><a href="../public/orders.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </nav>
            
            <?php
            if (empty($_SESSION['email'])){
                echo '<button><a href="../public/login.html">login</a></button>';
            }else{
                if ($_SESSION['type'] == 'admin'){
                    echo '<button><a href="../admin/admin.php"><i class="fa-solid fa-address-book"></i></a></button>';
                }else{
                    echo '<button><a href="../user/painel_controle.php"><i class="fa-solid fa-address-book"></i></a></button>';
                }
                
            }


            
            ?>
        
    </header>
    <a href="/public/index.php">Voltar para a página anterior</a>

    <?php
        echo "<h1>Ola {$_SESSION['name']}</h1>";
    ?>
    <section id="area-user">
        <ul>
            <li><div class="function-user">
                <a href="../public/orders.php"><i class="fa-solid fa-truck"></i><h2>Pedidos</h2></a>
            </div></li>
            <li><div class="function-user">
                <a href="../public/favorites.php"><i class="fa-regular fa-heart"></i><h2>Favoritos</h2></a>
            </div></li>
            <li><div class="function-user">
                <a href="../coming-soon.php"><i class="fa-solid fa-location-dot"></i><h2>Enderços</h2></a>
            </div></li>
            <li><div class="function-user">
                <a href="../coming-soon.php"><i class="fa-solid fa-credit-card"></i><h2>Formas de Pagamento</h2></a>
            </div></li>
            <li><div class="function-user">
                <a href="../coming-soon.php"><i class="fa-solid fa-gear"></i><h2>Configuraçoes</h2></a>
            </div></li>
            <li><div class="function-user">
                <a href="/exit.php"><i class="fa-solid fa-right-from-bracket"></i><h2>Sair</h2></a>
            </div></li>
        </ul>
    </section>

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