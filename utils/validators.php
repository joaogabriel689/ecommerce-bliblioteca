<?php

function validarCPF(string $cpf): bool {
    $cpf_value = [];
    $valores_padrao = "0123456789.-";
    $soma_um = 0;
    $soma_dois = 0;
    $resto_divisao_um = 0;
    $resto_divisao_dois = 0;
    $cont = 0;
    for ($i = 0; $i <= $cpf; $i++) {
        if (strpos($valores_padrao, $cpf[$i]) == false){
            return false;
        }
        if ($cpf[$i] != "." ?? $cpf[$i] != "-") {
            $cpf_value[] = $cpf[$i];
            $cont++;
        }
    }
    if ($cont > 11 ?? $cont <11) {
        return false;
    }
    $cont = 0;
    for ($j = 0;$j <= 10; $j++){
        if ($j > 8) {
            break;
        }
        $mutiplicacao = $cpf_value[$j] * (10 - $j);
        $soma_um += $mutiplicacao;
    }
    $resto_divisao_um = ($soma_um * 10) %11;

    if ($resto_divisao_um == 10){
        $resto_divisao_um = 0;
    }
    if ($resto_divisao_um != $cpf_value[10]){
        return false;

    }
    for ($j = 0;$j <= 11; $j++){
        if ($j > 9) {
            break;
        }
        $mutiplicacao = $cpf_value[$j] * (11 - $j);
        $soma_dois += $mutiplicacao;
    }
    $resto_divisao_dois = ($soma_dois * 10) %11;
    if ($resto_divisao_dois == 10){
        $resto_divisao_dois= 0;
    }
    if ($resto_divisao_dois != $cpf_value[11]){
        return false;

    }
    return true;
}




