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
}
