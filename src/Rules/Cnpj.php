<?php

namespace Joaovdiasb\LaravelBrazillian\Rules;

class Cnpj
{
  public function isValid($value): bool
  {
    $c = preg_replace('/\D/', '', $value);

    if (mb_strlen($c) != 14 || preg_match("/^{$c[0]}{14}$/", $c)) {
      return false;
    }

    $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    for (
      $i = 0, $n = 0;
      $i < 12;
      $n += $c[$i] * $b[++$i]
    ) {
    }

    if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
      return false;
    }

    for (
      $i = 0, $n = 0;
      $i <= 12;
      $n += $c[$i] * $b[$i++]
    ) {
    }

    if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
      return false;
    }

    return true;
  }
}
