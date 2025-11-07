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
    <link rel="stylesheet" href="/style/style.css">
    <title>bliblioteca online</title>
</head>
<body>
     <header>
        
            <div>
                <a href="index.php">
                    <img src="/images/logo-image.png" alt="">
                    <h1>bliblioteca online</h1>
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="">home</a></li>
                    <li><a href="">livros</a></li>
                    <li><a href=""><i class="fa-solid fa-heart"></i></a></li>
                    <li><a href=""><i class="fa-solid fa-cart-shopping"></i></a></li>
                </ul>
            </nav>
            <?php
            if (empty($_SESSION['user'])){
                echo '<button><a href="../public/login.html">login</a></button>';
            }else{
                if ($_SESSION['type'] == 'admin'){
                    echo '<button><a href="../admin/admin.php"><i class="fa-solid fa-user"></i></a></button>';
                }else{
                    echo '<button><a href="../user/painel_controle.php"><i class="fa-solid fa-user"></i></a></button>';
                }
                
            }


            
            ?>
        
    </header>

    <main>
                 <section id="catalog-books">
             <article>
                 <h2>Catálogo de Livros</h2>
             </article>
             <div id="books">
            <?php
                include '../config/connection.php';
                $sql = 'SELECT * FROM books;';
                $query = $connection->prepare($sql);
                $query->execute();
                $result = $query->get_result(); 
                $cont = 0;
                
                if($result->num_rows == 0){
                    echo "<p>Nenhum livro foi cadfavicon.icoastrado ainda</p>";
                }else{
                    $num_books = $result->num_rows; 
                    while($response = $result->fefavicon.icotch_assoc()){ 
                        if ($cont==$num_books){
                            break;
                        }
                        $cont = $cont + 1;

            ?>
                        <div class="card-product">
                            <div class="image-book">
                                <img src="/uploads/<?= $response['image'] ?>" alt="Capa do Livro">
                            </div>
                            <h3><?= $response['name'] ?></h3>
                            <p>R$ <?= $response['price'] ?></p>
                            <p><?= $response['decrib'] ?></p>
                            <form action="../process/orders/add-favorite.php" class="add-favorites">
                                <input type="hidden" name="name" value="<?= $response['name'] ?>">
                                <input type="submit" value="adicionar aos favoritos">
                            </form>
                            <form action="../process/orders/add-car.php" class="add-car">
                                <input type="hidden" name="name" value="<?= $response['name'] ?>">
                                <input type="submit" value="adicionar ao carrinho">
                            </form>
                        </div>

            <?php

                    }
                }
            ?>
             </div>
         </section>
    </main>
     <footer>
        <section id="social-media">
            <a href="https://www.instagram.com/joao_pereira_couto/"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://github.com/joaogabriel689"><i class="fa-brands fa-github"></i></a>
            <a href="https://www.linkedin.com/in/joao-couto-b55b04321/"><i class="fa-brands fa-linkedin"></i></a>

        </section>
        <p>&copy; 2024 Biblioteca Online. Todos os direitos reservados.</p>

    </footer>
    
</body>
</html>
    