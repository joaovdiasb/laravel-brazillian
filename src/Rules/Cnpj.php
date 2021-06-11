<?php

namespace Joaovdiasb\LaravelBrazillian\Rules;

class Cnpj
{
  public function isValid($value): bool
  {
    // Extrai somente os números
    $cnpj = preg_replace('/\D/', '', $value);

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cnpj) != 14) return false;

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 11.111.111/111-11
    if (preg_match('/(\d)\1{13}/', $cnpj)) return false;

    // Valida primeiro dígito verificador
    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
      $soma += $cnpj[$i] * $j;
      $j = ($j == 2) ? 9 : $j - 1;
    }

    $resto = $soma % 11;

    if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) return false;

    // Valida segundo dígito verificador
    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
      $soma += $cnpj[$i] * $j;
      $j = ($j == 2) ? 9 : $j - 1;
    }

    $resto = $soma % 11;

    return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
  }
}
