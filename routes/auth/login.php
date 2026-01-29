<?php

/**
 * Configura o cookie da sessão para ser acessível apenas via HTTP
 * (impede acesso por JavaScript, aumentando a segurança)
 */
session_set_cookie_params(['httponly' => true]);

/**
 * Inicia a sessão
 */
session_start();

/**
 * Regenera o ID da sessão para evitar session fixation
 */
session_regenerate_id(true);

/**
 * Verifica se o usuário já está logado
 * Caso exista a sessão "user", impede novo login
 */
if (isset($_SESSION["user"])) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "User already logged in"
    ]);
    exit();
}

// Importa o controller de autenticação
include("../../controllers/authcontroller.php");

/**
 * Obtém o corpo bruto da requisição HTTP
 * Geralmente utilizado para requisições JSON (POST, PUT, etc)
 */
$body = file_get_contents('php://input');

/**
 * Decodifica o JSON recebido para um array associativo
 */
$content = json_decode($body, true);

/**
 * Verifica se o JSON é válido
 */
if (!$content) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Invalid JSON input"
    ]);
    exit();
}

/**
 * Verifica se os campos obrigatórios estão presentes
 */
if (
    isset($content["email"]) == false ||
    isset($content["password"]) == false
) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Missing required fields"
    ]);
    exit();
}

/**
 * Extrai os dados do corpo da requisição
 */
$email = $content["email"];
$password = $content["password"];

/**
 * Cria o controller de autenticação
 * e executa a ação de login
 */
$authcontroller = new AuthController();
$action = $authcontroller->login($email, $password);

/**
 * Retorna a resposta apropriada com base
 * no resultado da autenticação
 */
if ($action['status'] == false) {

    // Login inválido
    http_response_code(400);
    echo json_encode([
        'status'  => false,
        'message' => $action['message']
    ]);
    exit();

} else {

    // Login realizado com sucesso
    // Cria a sessão do usuário autenticado
    $_SESSION['user'] = $action['data'];
    http_response_code(200);
            
    echo json_encode([
        'status'  => true,
        'message' => $action['message'],
        'data'    => $action['data']
    ]);
}
