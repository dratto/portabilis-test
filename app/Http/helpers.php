<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

/**
 * Verifica se o arranjo é composto apenas por valores do tipo FALSE
 *
 * @see http://php.net/manual/pt_BR/function.array-filter.php
 * @param array $array O arranjo a ser analisado
 * @return bool Se o arranjo é considerado vazio ou não
 */
function array_empty(Array $array = [])
{
    return empty(array_filter($array));
}

/**
 * Indica se a variável é do tipo coleção - as mais utilizadas no projeto.
 * Suporta as coleções do Eloquent e helper de suporte do Laravel.
 *
 * @param mixed $variable
 * @return boolean
 */
function is_collection($variable = [])
{
    return (($variable instanceof Collection) || ($variable instanceof SupportCollection));
}

/**
 * Transforma um valor numérico de decimal para centena.
 *
 * @param $decimal
 * @return mixed
 */
function decimal_to_cent($decimal)
{
    if (! is_numeric($decimal)) {
        throw new InvalidArgumentException('The value must be a number.');
    }
    return ($decimal * 100);
}

/**
 * Retorna apenas os valores numéricos presentes no valor informado.
 *
 * @param string $value
 * @return string
 */
function numbers_only($value)
{
    return is_string($value) ? preg_replace('/\D/i', '', $value) : '';
}


function regex_cpf()
{
    return '(^[0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2}$)';
}

function is_cpf($value)
{
    return is_string($value) ? (strlen(numbers_only($value)) === 11) : false;
}


function regex_cnpj_cpf()
{
    $cpfRegex   = regex_cpf();
    $cnpjRegex  = regex_cnpj();

    return "({$cnpjRegex}|{$cpfRegex})";
}


/**
 * Helper responsável por fazer máscara de valores como telefone, cep, cnpj, rg e etc.
 *
 * @param string $mask = Formato de como deverá ser feita a máscara. Ex: (##) ####-####
 * @param string $str  = Valor que deverá receber a formatação.
 * @return mixed
 */
function mask($mask,$str)
{
    $str = str_replace(" ","",$str);

    for ($i=0;$i<strlen($str);$i++) {
        $strpos = strpos($mask,"#");
        if ($strpos !== false) {
            $mask[strpos($mask,"#")] = $str[$i];
        }
    }

    return $mask;
}

/**
 * Helper responsável por validar se o numero de telefone é um 0800.
 *
 * @param string $phone = número de telefone
 * @return boolean
 */
function isFreePhone($phone)
{
    return preg_match('/0800[0-9]{3}[0-9]{3}/', $phone);
}


function isValidCPF($cpf)
{
    $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);

    $invalids = [
        '00000000000',
        '11111111111',
        '22222222222',
        '33333333333',
        '44444444444',
        '55555555555',
        '66666666666',
        '77777777777',
        '88888888888',
        '99999999999'
    ];

    if (in_array($cpf, $invalids)) {
        return false;
    }

    if (strlen($cpf) != 11) {
        return false;
    }

    for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--) {
        $soma += $cpf{$i} * $j;
    }

    $resto = $soma % 11;

    if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto)) {
        return false;
    }

    for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--) {
        $soma += $cpf{$i} * $j;
    }

    $resto = $soma % 11;

    return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
}

