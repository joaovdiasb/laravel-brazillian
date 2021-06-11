<?php

namespace Joaovdiasb\LaravelBrazillian;

use Illuminate\Validation\Validator;
use Joaovdiasb\LaravelBrazillian\Rules\{Cep, Cpf, Cnpj};

class Validation extends Validator
{
  protected function validateFormatoCpf($attribute, $value): bool
  {
    return (new Cpf)->isValidFormat($value);
  }

  protected function validateFormatoCnpj($attribute, $value): bool
  {
    return (new Cnpj)->isValidFormat($value);
  }

  protected function validateFormatoCpfCnpj($attribute, $value): bool
  {
    return (new Cpf)->isValidFormat($value) || (new Cnpj)->isValidFormat($value);
  }

  protected function validateFormatoCep($attribute, $value): bool
  {
    return (new Cep)->isValidFormat($value);
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
