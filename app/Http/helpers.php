<?php

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

function string_to_decimal($string)
{
    return str_replace(['.', ','] , ['', '.'], $string);
}

function format_to_money($value)
{
    return 'R$'. str_replace('.', ',', $value);
}

