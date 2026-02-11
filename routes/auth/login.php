<?php

// Sempre iniciar sessão primeiro
session_set_cookie_params([
    'httponly' => true,
    'secure'   => false, // coloque true se estiver usando HTTPS
    'samesite' => 'Strict'
]);

session_start();

// Define header JSON
header('Content-Type: application/json');

// Se já estiver logado, bloqueia novo login
if (isset($_SESSION["user"])) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "User already logged in"
    ]);
    exit();
}

// Importa controller
require_once("../../controllers/authcontroller.php");

// Pega body da requisição
$body = file_get_contents('php://input');
$content = json_decode($body, true);

// Verifica JSON inválido
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Invalid JSON input"
    ]);
    exit();
}

// Verifica campos obrigatórios
if (
    empty($content["email"]) ||
    empty($content["password"])
) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Missing required fields"
    ]);
    exit();
}

$email = $content["email"];
$password = $content["password"];

// Executa login
$authcontroller = new AuthController();
$action = $authcontroller->login($email, $password);

if ($action['status'] === false) {

    http_response_code(400);
    echo json_encode([
        'status'  => false,
        'message' => $action['message']
    ]);
    exit();

} else {

    // Regenera ID SOMENTE após login válido
    session_regenerate_id(true);

    $_SESSION['user'] = $action['data'];

    http_response_code(200);
    echo json_encode([
        'status'  => true,
        'message' => $action['message'],
        'data'    => $action['data']
    ]);
}
