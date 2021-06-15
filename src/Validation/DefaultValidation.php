<?php

namespace Joaovdiasb\LaravelBrazillian\Validation;

use Illuminate\Validation\Validator;

class DefaultValidation extends Validator
{
  protected function validateFormatoCpf(): bool
  {
    return true;
  }

  protected function validateFormatoCnpj(): bool
  {
    return true;
  }

  protected function validateFormatoCpfCnpj(): bool
  {
    return true;
  }

  protected function validateFormatoCep(): bool
  {
    return true;
  }

  protected function validateCpf(): bool
  {
    return true;
  }

  protected function validateCnpj(): bool
  {
    return true;
  }

  protected function validateCpfCnpj(): bool
  {
    return true;
  }

  protected function validateCep(): bool
  {
    return true;
  }

  protected function validateUf(): bool
  {
    return true;
  }

  protected function validateTelefone(): bool
  {
    return true;
  }

  protected function validateTelefoneComDdd(): bool
  {
    return true;
  }

  protected function validateTelefoneComCodigo(): bool
  {
    return true;
  }

  protected function validateCelular(): bool
  {
    return true;
  }

  protected function validateCelularComDdd(): bool
  {
    return true;
  }

  protected function validateCelularComCodigo(): bool
  {
    return true;
  }

  protected function validateTelefoneCelular(): bool
  {
    return true;
  }

  protected function validateTelefoneCelularComDdd(): bool
  {
    return true;
  }

  protected function validateTelefoneCelularComCodigo(): bool
  {
    return true;
  }
}
