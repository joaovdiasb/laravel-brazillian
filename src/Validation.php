<?php

namespace Joaovdiasb\LaravelBrazillian;

use Illuminate\Validation\Validator;
use joaovdiasb\LaravelBrazillian\Rules\{Cnpj, Cpf};

class Validation extends Validator
{
  protected function validateFormatoCpf($attribute, $value): bool
  {
    return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value) > 0;
  }

  protected function validateFormatoCnpj($attribute, $value): bool
  {
    return preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $value) > 0;
  }

  protected function validateFormatoCpfCnpj($attribute, $value): bool
  {
    return $this->validateFormatoCpf($attribute, $value) || $this->validateFormatoCnpj($attribute, $value);
  }

  protected function validateCpf($attribute, $value): bool
  {
    return (new Cpf)->validateCpf($attribute, $value);
  }

  protected function validateCnpj($attribute, $value): bool
  {
    return (new Cnpj)->validateCnpj($attribute, $value);
  }

  protected function validateCpfCnpj($attribute, $value): bool
  {
    return ((new Cpf)->validateCpf($attribute, $value) || (new Cnpj)->validateCnpj($attribute, $value));
  }
}
