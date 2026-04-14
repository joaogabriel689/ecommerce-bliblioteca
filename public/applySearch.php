<?php

/**
 * 
 * @author Luiz-Mtca-tech
 * 
 * Arquivo para manipular o controller do motor de busca da página
 * principal do site(index.php) Cria uma instancia do Controller de
 * Produtos e buscas o registros, mais parecidos, com o termo informdado
 * no campo de busca.
 * 
 */


include_once __DIR__.'/../controllers/productcontroller.php';

$control = new Productcontroller();

//o filtro aplicado será de caracteres especiais.
$search_string = filter_input(INPUT_POST, "search", FILTER_SANITIZE_SPECIAL_CHARS);

//$result = $control->list_products($search_string);
/**
 * Enviando os registros encontrados de volta
 */
echo json_encode($control->list_products($search_string));