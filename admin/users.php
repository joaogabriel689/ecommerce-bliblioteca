<?php
    session_start();

        

    if (!isset($_SESSION['email']) || !isset($_SESSION['type'])) {

        header("Location: ../public/login.html");
        exit;
    }


    if ($_SESSION['type'] !== 'admin') {
        header("Location: ../public/index.php");
        exit;
    }
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


    <link rel="stylesheet" href="../style/admin.css">
    <link rel="stylesheet" href="../style/catalog.css">
    <link rel="stylesheet" href="../style/auth.css">
    <script src="../script/script.js"></script>
    <title>bliblioteca online</title>
</head>
<body>
     <header>
        
            <div>
                <a href="../public/index.php">
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


        <a href="admin.php">Voltar para a página anterior</a>

        <?php
         echo "<h1>Ola {$_SESSION['name']}, aqui voce pode gerenciar os usuarios.</h1>";
                ?>
        <h2>cadastrar usuario:</h2>
        <div id="area-register">
            <form action="/process/process-register.php" method="post">
                    <h1>registrar:</h1>
                    <div class="name">
                        <label for="name">nome:</label>
                        <input type="text" name="name">
                    </div>
                    <div class="email">
                        <label for="email">email:</label>
                        <input type="text" name="email">
                    </div>
                    <div class="adress">
                        <label for="adress">endereço:</label>
                        <input type="text" name="adress">
                    </div>
                    <div class="state">
                        <label for="state">estado:</label>
                        <input type="text" name="state">
                    </div>
                    <div class="city">
                        <label for = "city">cidede:</label>
                        <input type="text" name="city">
                    </div>
                    <div class="fone">
                        <label for="fone">telefone</label>
                        <input type="number" name="fone">
                    </div>
                    <div class="password">
                        <label for="password">senha:</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <input type="submit" value="cadastrar" id="register">
                </form>
        </div>
        <section id="list-users">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Enderço</th>
                        <th>Estado</th>
                        <th>Cidade</th>
                        <th>Telefone</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        include '../config/connection.php';
                        include '../class/usersclass.php';

                        $response = User::select_all_user($connection);
                       
                        
                        if($response['status'] == false){
                            echo "<p>Nenhum usuario foi cadastrado ainda</p>";
                        }else{
                            $data = $response['data'];
                            foreach($data as $user){ 
                    ?>
                            <tr>
                                <td><?= $user['nome']?></td>
                                <td><?= $user['email']?></td>
                                <td><?= $user['endereco']?></td>
                                <td><?= $user['estado']?></td>
                                <td><?= $user['cidade']?></td>
                                <td><?= $user['telefone']?></td>
                                <td>
                                    <form action="../process/process-user-delete.php" method="post">
                                        <input type="hidden" name="email" value="<?= $user['email'] ?>">
                                        <input type="submit" value="deletar">
                                    </form>
                                </td>
                                <td>
                                    <form action="user-alter.php" method="post">
                                        <input type="hidden" name="email" value="<?= $user['email'] ?>">
                                        <input type="submit" value="alterar">
                                    </form>
                                </td>
                                
                            </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </section>


    </main>


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
