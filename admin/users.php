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
    <link rel="stylesheet" href="/style/style.css">
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
         echo "<h1>Ola, {$_SESSION['name']}, aqui voce pode gerenciar os usuarios.</h1>";
                ?>
        <h2>cadastrar usuario:</h2>
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
                        <th>Apagar</th>
                        <th>Editar</th>
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
                                    <form action="../process/user-alter.php" method="post">
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
