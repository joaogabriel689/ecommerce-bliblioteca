<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config/connection.php'; // ajuste o caminho conforme seu projeto
require_once '../class/usersclass.php';


// 🧩 1. Cria a conexão com o banco (caso não esteja no connection.php)
if (!isset($connection)) {
    try {
        $connection = new PDO("mysql:host=localhost;dbname=seu_banco;charset=utf8", "root", "");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }
}

// 🧍 Dados de teste
$name = "João caralho";
$email = "joao.teste114@example.com";
$pass = "123456";
$adress = "Rua das pirocas, 100";
$city = "Rio de guerra";
$state = "RJ";
$fone = 67999999999;

// 🧱 2. Cria o objeto usuário
$user = new User($name, $email, $pass, $adress, $city, $state, $fone, $connection);

// 🔹 3. Testa o cadastro
echo "---- TESTE DE CADASTRO ----<br>";
$result = $user->register();
print_r($result);
echo "<br><br>";

// 🔹 4. Testa o login
echo "---- TESTE DE LOGIN ----<br>";
$login = $user->login();
print_r($login);
echo "<br><br>";

// 🔹 5. Testa atualização
echo "---- TESTE DE ATUALIZAÇÃO ----<br>";
$user = new User("João Atualizado", $email, $pass, "Av. Central, 200", "São Paulo", "SP", 11988887777, $connection);
$update = $user->update_user();
print_r($update);
echo "<br><br>";

// 🔹 6. Testa seleção de um usuário
echo "---- TESTE DE SELECT ÚNICO ----<br>";
$select = User::select_user($email, $connection);
print_r($select);
echo "<br><br>";

// 🔹 7. Testa seleção de todos os usuários
echo "---- TESTE DE SELECT TODOS ----<br>";
$all = User::select_all_user($email, $connection);
print_r($all);
echo "<br><br>";

// 🔹 8. Testa exclusão do usuário
echo "---- TESTE DE DELETE ----<br>";
$delete = User::delete_user($email, $connection);
print_r($delete);
echo "<br><br>";

// 🔹 9. Confirma que foi excluído
echo "---- TESTE DE CONFIRMAÇÃO ----<br>";
$check = User::select_user($email, $connection);
print_r($check);
echo "<br><br>";

echo "✅ Fim dos testes!";
?>
