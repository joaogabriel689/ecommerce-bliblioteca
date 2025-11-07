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
    include '../config/connection.php';
    $id = $_POST['id'] ?? "";
    $sql = 'SELECT * FROM users WHERE id = ?;';
    $query = $connection->prepare($sql);
    $query->bind_param('s', $id);
    $query->execute();
    $result = $query->get_result();
    $response = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
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
    <form action="/process/users-process/process-user-alter.php" method = "post">
       
        <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>idade</th>
                            <th>nickname</th>
                            <th>tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> 
                            <input type="hidden" name="id" value = "<?=$response['id'] ?? ''?>">
                            <td><input type="text" name="name" value="<?=$response['name'] ?? ''?>"></td>
                            <td><input type="text" name="age" value="<?=$response['age'] ?? '' ?>"></td>
                            <td><input type="text" name="nickname" value="<?=$response['nickname'] ?? '' ?>"></td>
                            <td><input type="text" name="type" value="<?=$response['type'] ?? '' ?>"></td>
                        </tr>
                    </tbody>
        </table>
        <input type="submit" value="alterar">
    </form>
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