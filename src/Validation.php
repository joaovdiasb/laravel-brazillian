<?php

namespace Joaovdiasb\LaravelBrazillian;

use Illuminate\Validation\Validator;
use Joaovdiasb\LaravelBrazillian\Rules\{Cep, Cpf, Cnpj, Telefone, Celular, Uf};

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

  protected function validateUf($attribute, $value): bool
  {
    return (new Uf)->isValid($value);
  }

  protected function validateTelefone($attribute, $value): bool
  {
    return (new Telefone)->isValid($value);
  }

  protected function validateTelefoneComDdd($attribute, $value): bool
  {
    return (new Telefone)->isValidWithDdd($value);
  }

  protected function validateTelefoneComCodigo($attribute, $value): bool
  {
    return (new Telefone)->isValidWithCode($value);
  }

  protected function validateCelular($attribute, $value): bool
  {
    return (new Celular)->isValid($value);
  }

  protected function validateCelularComDdd($attribute, $value): bool
  {
    return (new Celular)->isValidWithDdd($value);
  }

  protected function validateCelularComCodigo($attribute, $value): bool
  {
    return (new Celular)->isValidWithCode($value);
  }

  protected function validateTelefoneCelular($attribute, $value): bool
  {
    return ((new Telefone)->isValid($value) || (new Celular)->isValid($value));
  }

  protected function validateTelefoneCelularComDdd($attribute, $value): bool
  {
    return ((new Telefone)->isValidWithDdd($value) || (new Celular)->isValidWithDdd($value));
  }

  protected function validateTelefoneCelularComCodigo($attribute, $value): bool
  {
    return ((new Telefone)->isValidWithCode($value) || (new Celular)->isValidWithCode($value));
  }
}
