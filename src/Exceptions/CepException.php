<?php

namespace Joaovdiasb\LaravelBrazillian\Exceptions;

use Exception;

class CepException extends Exception
{
  public static function notFound(string $cep): self
  {
    return new static("CEP \"{$cep}\" não encontrado na base da dados dos Correios");
  }

  public static function invalidLength(): self
  {
    return new static("Tamanho do CEP inválido");
  }
}
