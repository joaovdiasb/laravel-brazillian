<?php

namespace Joaovdiasb\LaravelBrazillian\Rules;

class Cpf
{
  public function isValid($value): bool
  {
    // Extrai somente os números
    $cpf = preg_replace('/\D/', '', $value);

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) return false;

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) return false;

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf[$c] * (($t + 1) - $c);
      }

      $d = ((10 * $d) % 11) % 10;

      if ($cpf[$c] != $d) {
        return false;
      }
    }

    return true;
  }
}
