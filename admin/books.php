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
    <link rel="stylesheet" href="style/admin">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="shortcut icon" href="/images/logo-image.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style/style.css">
    <title>bliblioteca online</title>
</head>
<body>
    <header>
        
            <div>
                <a href="/public/index.php">
                    <img src="/images/logo-image.png" alt="">
                    <h1>bliblioteca online</h1>
                </a>
            </div>

        
    </header>
    <main>
        <a href="javascript:history.back()">Voltar para a página anterior</a>

        <?php
         echo "<h1>Ola {$_SESSION['name']}, aqui voce pode gerenciar o catalogo de livros.</h1>";

        ?>
        <h2>cadastrar livro</h2>
        <form action="../process/process-book-post.php" method="post" enctype="multipart/form-data">
                <h3>registrar:</h3>
                <div class="name">
                    <label for="name">nome:</label>
                    <input type="text" name="name">
                </div>
                <div class="price">
                    <label for="price">preço:</label>
                    <input type="text" name="price" id="price">
                </div>
                <div class="describe">    
                    <label for="describe">descriçao</label>
                    <input type="text" name="describe" id="describe">
                </div>
                <div class="stock">    
                    <label for="stock">estoque</label>
                    <input type="number" name="stock" id="stock">
                </div>
                <input type="submit" value="cadastrar" id="register">
        </form>

        <section id="list-books">
        <?php
                include '../config/connection.php';
                include '../class/productclass.php';
                
                $count = 0;

                $result = Product::select_all_products($connection);

                
                if($result['status'] == false){
                    echo "<p>Nenhum livro foi cadastrado ainda</p>";
                }else{
                    $products = $result['data'];
                    foreach ($products as $product){
                ?>
                                <div class="card-product">
                                    <div class="image-book">
                                        <img src="" alt="Capa do Produto">
                                    </div>

                                    <h3><?= $product['nome'] ?></h3>
                                    <p>R$ <?= $product['valor'] ?></p>
                                    <p><?= $product['descricao'] ?></p>
                                    <p>Estoque: <?= $product['qtd'] ?></p>

                                    <form action="../process/process-product-delete.php" method="post">
                                        <input type="hidden" name="name" value="<?= $product['nome'] ?>">
                                        <input type="submit" value="apagar">
                                    </form>

                                    <form action="book-alter.php" method="post">
                                        <input type="hidden" name="name" value="<?= $product['nome'] ?>">
                                        <input type="submit" value="editar">
                                    </form>
                                </div>
                    <?php
                            }
                        }
                    ?>
                    

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
