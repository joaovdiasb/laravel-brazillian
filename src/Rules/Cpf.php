<?php

namespace Joaovdiasb\LaravelBrazillian\Rules;

class Cpf
{
  public function isValid($value): bool
  {
    $c = preg_replace('/\D/', '', $value);

    if (mb_strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
      return false;
    }

    for (
      $s = 10, $n = 0, $i = 0;
      $s >= 2;
      $n += $c[$i++] * $s--
    ) {
    }

    if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
      return false;
    }

    for (
      $s = 11, $n = 0, $i = 0;
      $s >= 2;
      $n += $c[$i++] * $s--
    ) {
    }

    if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
      return false;
    }

    return true;
  }
}
