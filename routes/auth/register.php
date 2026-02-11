<?php

// Inicia a sessão PHP
session_start();

/**
 * Verifica se o usuário já está logado
 * Impede o registro caso exista uma sessão ativa
 */
if (isset($_SESSION["user"])) {
    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => "User already logged in"
    ]);
    exit();
}

// Importa o controller responsável pela autenticação
include_once __DIR__ . "/../../controllers/AuthController.php";

/**
 * Obtém o corpo bruto da requisição HTTP
 */
$body = file_get_contents('php://input');

/**
 * Decodifica o JSON recebido em um array associativo
 */
$content = json_decode($body, true);

/**
 * Verifica se o JSON é válido
 */
if (!$content) {
    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => "Invalid JSON input"
    ]);
    exit();
}

/**
 * Verifica se todos os campos obrigatórios estão presentes
 */
if (
    isset($content["nome"]) == false ||
    isset($content["email"]) == false ||
    isset($content["cpf"]) == false ||
    isset($content["password"]) == false ||
    isset($content["data_nascimento"]) == false ||
    isset($content["phone"]) == false
) {
    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => "Missing required fields"
    ]);
    exit();
}

/**
 * Atribui os dados recebidos às variáveis locais
 */
$nome             = $content["nome"];
$email            = $content["email"];
$cpf              = $content["cpf"];
$senha            = $content["password"];
$data_nascimento  = $content["data_nascimento"];
$phone            = $content["phone"];

/**
 * Cria o controller de autenticação
 * Registra o usuário com perfil padrão "cliente"
 */
$authcontroller = new AuthController();
$action = $authcontroller->register(
    $nome,
    $email,
    $cpf,
    $senha,
    $data_nascimento,
    $phone,
    0,              // compras iniciais
    "cliente"       // grupo padrão
);

/**
 * Retorna a resposta conforme o resultado do registro
 */
if ($action["status"] === false) {

    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => $action["message"]
    ]);

} else {

    http_response_code(200);
    echo json_encode([
        "status"  => true,
        "message" => $action["message"],
    ]);
}
