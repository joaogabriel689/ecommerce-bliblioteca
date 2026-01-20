<?php

session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="shortcut icon" href="/images/logo-image.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style/base.css">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/user.css">
    <link rel="stylesheet" href="../style/orders.css">
    <script src="../script/script.js"></script>

    <title>bliblioteca online</title>
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
    <main>
            <div class="orders-page">
                    <?php
                    $total = 0;
                    foreach($_SESSION['orders'] as $product){
                        $total = $total +  ($product['value'] * $product['qtd'])
                        ?>
                        <div class="product-order " >
                            <h3><?= $product['name'] ?></h3>
                            <p>R$ <?= $product['value'] ?></p>
                            <p>quantidade: <?= $product['qtd'] ?></p>
                            <p>Subtotal: R$ <?php $product['value'] * $product['qtd']?></p>

                        </div>

                    <?php
                    }
                    ?>
                        <div class="total-order" >
                            <p><?php $total ?></p>
                            <form action="" method="post">
                                <label for=""><?php $total ?></label>
                                <input type="submit" value="comprar">
                            </form>
                                
                        </div>
                    <?php

                    ?>
            </div>
    </main>
    <footer>
        <section id="social-media">
            <a href="https://www.instagram.com/joao_pereira_couto/"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://github.com/joaogabriel689"><i class="fa-brands fa-github"></i></a>
            <a href="https://www.linkedin.com/in/joao-couto-b55b04321/"><i class="fa-brands fa-linkedin"></i></a>

        </section>
        <p>&copy; 2024 Biblioteca Online. Todos os direitos reservados.</p>

    </footer>
    <main>
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
    </main>
    
</body>
</html>