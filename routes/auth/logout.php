<?php

// Inicia a sessão
session_start();

/**
 * Verifica se o usuário já está deslogado
 * Caso não exista a sessão "user", impede o logout
 */
if (isset($_SESSION["user"]) == false) {
    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => "User not logged in"
    ]);
    exit();
}

// Importa o controller de autenticação
include("../../controllers/authcontroller.php");



/**
 * Obtém o campo "logout" do corpo da requisição
 * Espera-se um valor booleano
 */
$logout = $_POST["logout"];

/**
 * Verifica se a requisição de logout é válida
 */
if ($logout === true) {

    // Cria o controller de autenticação
    $authcontroller = new AuthController();

    // Executa a ação de logout
    $action = $authcontroller->logout();

    /**
     * Retorna a resposta de acordo com o resultado
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
            "message" => $action["message"]
        ]);
    }

} else {

    /**
     * Caso o campo logout não seja true,
     * a requisição é considerada inválida
     */
    http_response_code(400);
    echo json_encode([
        "status"  => false,
        "message" => "Invalid logout request"
    ]);
}
