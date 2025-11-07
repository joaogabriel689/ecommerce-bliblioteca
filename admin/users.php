<?php
    session_start();

        

    if (!isset($_SESSION['user']) || !isset($_SESSION['type'])) {

        header("Location: /public/login.html");
        exit;
    }


    if ($_SESSION['type'] !== 'admin') {
        header("Location: /public/index.php");
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
        <form action="/process/login-register/process-register.php" method="post">
                <h1>registrar:</h1>
                <div class="name">
                    <label for="name">nome:</label>
                    <input type="text" name="name">
                </div>
                <div class="age">
                    <label for="age">idade</label>
                    <input type="number" name="age" id="age">
                </div>
                <div class="nickname">
                    <label for="user">usuario:</label>
                    <input type="text" name="user">
                </div>
                <div class="password">    
                    <label for="password">senha:</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="type">    
                    <label for="type">type:</label>
                    <select id="type" name="type" multiple>
                    <option value="admin">admin</option>
                    <option value="defaut">client</option>
                    </select>
                </div>
                <input type="submit" value="cadastrar" id="register">
            </form>
        <section id="list-users">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>Nickname</th>
                        <th>Tipo</th>
                        <th>deletar</th>
                        <th>editar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        include '../config/connection.php';
                        $sql = 'SELECT * FROM users;';
                        $query = $connection->prepare($sql);
                        $query->execute();
                        $result = $query->get_result(); 
                        
                        if($result->num_rows == 0){
                            echo "<p>Nenhum usuario foi cadastrado ainda</p>";
                        }else{
                            while($response = $result->fetch_assoc()){ 
                    ?>
                            <tr>
                                <td><?= $response['name']?></td>
                                <td><?= $response['age']?></td>
                                <td><?= $response['nickname']?></td>
                                <td><?= $response['type']?></td>
                                <td>
                                    <form action="/process/users-process/process-user-delete.php" method="post">
                                        <input type="hidden" name="nickname" value="<?= $response['nickname'] ?>">
                                        <input type="submit" value="deletar">
                                    </form>
                                </td>
                                <td>
                                    <form action="/process/users-process/user-alter.php" method="post">
                                        <input type="hidden" name="id" value="<?= $response['id'] ?>">
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
