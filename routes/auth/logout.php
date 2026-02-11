<?php

session_set_cookie_params([
    'httponly' => true,
    'secure'   => false, // coloque true se estiver em HTTPS
    'samesite' => 'Strict'
]);

session_start();

header('Content-Type: application/json');

// Verifica se está logado
if (!isset($_SESSION["user"])) {
    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => "User not logged in"
    ]);
    exit();
}

// Destroi todos os dados da sessão
$_SESSION = [];

// Remove cookie da sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destrói sessão
session_destroy();

http_response_code(200);
echo json_encode([
    "status"  => true,
    "message" => "Logout successful"
]);
