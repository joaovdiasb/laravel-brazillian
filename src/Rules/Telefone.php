<?php

namespace Joaovdiasb\LaravelBrazillian\Rules;

class Telefone
{
  public function isValid($value): bool
  {
    return preg_match('/^\d{4}-\d{4}$/', $value) > 0;
  }

  public function isValidWithDdd($value): bool
  {
    return preg_match('/^\(\d{2}\)\s?\d{4}-\d{4}$/', $value) > 0;
  }

  public function isValidWithCode($value): bool
  {
    return preg_match('/^[+]\d{1,2}\s?\(\d{2}\)\s?\d{4,5}\-\d{4}$/', $value) > 0;
  }
}
