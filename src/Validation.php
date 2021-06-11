<?php

namespace Joaovdiasb\LaravelBrazillian;

use Illuminate\Validation\Validator;
use Joaovdiasb\LaravelBrazillian\Rules\{Cep, Cpf, Cnpj};

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

  protected function validateFormatoCep($attribute, $value): bool
  {
    return preg_match('/[0-9]{5}-[\d]{3}/', $value) > 0;
  }

  protected function validateCpf($attribute, $value): bool
  {
    return (new Cpf)->isValid($value);
  }

  protected function validateCnpj($attribute, $value): bool
  {
    return (new Cnpj)->isValid($value);
  }

  protected function validateCpfCnpj($attribute, $value): bool
  {
    return ((new Cpf)->isValid($value) || (new Cnpj)->isValid($value));
  }

  protected function validateCep($attribute, $value): bool
  {
    return (new Cep)->isValid($value);
  }
}
