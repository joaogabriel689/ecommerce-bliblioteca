<?php
/**
 *	Este arquivo é para o filtro de busca na página principal
 *  (public/index.php) 
 * 
 **/

ini_set("display_errors", 1);
ini_set("display_ini_set" ,1);
error_reporting(E_ALL);

/**
 *	Por enquanto, fiz apenas alguns testes para averiguar se os dados do formulário
 * estão chegando conforme o esperado. Aparentemente, tudo está ok!
 * 
 * - Próximo passo é decidir se vamos usar um controller para trazer os dados do DB, ou
 * se vamos fazer do zero essa manipulação 
 * 
 **/

$lista[0] = filter_input(INPUT_POST, "new", FILTER_SANITIZE_SPECIAL_CHARS);
$lista[1] = filter_input(INPUT_POST, "sale", FILTER_SANITIZE_SPECIAL_CHARS);
$lista[2] = filter_input(INPUT_POST, "price-range", FILTER_VALIDATE_INT);
$lista[3] = filter_input(INPUT_POST, "cover-hard", FILTER_SANITIZE_SPECIAL_CHARS);
$lista[4] = filter_input(INPUT_POST, "cover-hard", FILTER_SANITIZE_SPECIAL_CHARS);
$lista[5] = filter_input(INPUT_POST, "cover-normal", FILTER_SANITIZE_SPECIAL_CHARS);

print_r($lista);

