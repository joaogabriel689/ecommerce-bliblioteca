<?php

/**
 * Este arquivo faz a manipulação do controller productcontroller.php
 * Busca as informações necessárias para trazer os anúncios na página
 * ./index.php
 * @author Luiz Henrique
 */

/*
 * Confirgurando a reportagem de erros da página, para que seja
 * notificado a qualquer impecílio ou falha do programa.
 */
ini_set("display_errors", 1);
ini_set("display_ini_set", 1);
error_reporting(E_ALL);


/*
 *Invocando a classe Controller dos produtos
 */
require_once __DIR__."/../controllers/productcontroller.php";
$control = new Productcontroller();


/*
 * Mandando os registros para a página principal, no formato
 * JSON
 * ! Pode ser que seja alterado em futuras versões.
 */
echo json_encode($control->index());