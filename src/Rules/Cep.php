<?php

namespace Joaovdiasb\LaravelBrazillian\Rules;

use Joaovdiasb\LaravelBrazillian\Services\ApiCep;

class Cep
{
  public function isValid($value): bool
  {
    try {
      (new ApiCep)->setCep($value)->search();
    } catch (\Exception $e) {
      return false;
    }

    return true;
  }

  public function isValidFormat($value): bool
  {
    return preg_match('/[0-9]{5}-[\d]{3}/', $value) > 0;
  }
}
