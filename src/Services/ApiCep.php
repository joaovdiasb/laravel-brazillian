<?php

namespace Joaovdiasb\LaravelBrazillian\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Joaovdiasb\LaravelBrazillian\Exceptions\CepException;

class ApiCep extends Http
{
  private string $cep = '';

  private PendingRequest $client;

  public function __construct()
  {
    $this->client = self::withHeaders([
      'Content-Type' => 'application/json'
    ])->withOptions(['verify' => false]);
  }

  public function setCep(string $cep): self
  {
    $this->cep = $cep;

    return $this;
  }

  public function search()
  {
    foreach ($this->services() as $service) {
      try {
        $client = $this->client
          ->baseUrl($service['baseUrl'])
          ->get($service['url'] ?? '', $service['query'] ?? '');

        $body = json_decode($client->body(), true);
      } catch (\Exception $e) {
        continue;
      }

      if (optional($body)[$service['expect_key']] === $this->cep) {
        return $body;
      } elseif (optional($client)->getStatusCode()) {
        throw CepException::notFound($this->cep);
      }
    }
  }

  private function services(): array
  {
    $parsedCep = preg_replace('/[^0-9]/', '', $this->cep);

    return [
      [
        'baseUrl' => 'viacep.com.br/ws/',
        'url' => "{$parsedCep}/json/",
        'expect_key' => 'cep'
      ],
      [
        'baseUrl' => 'ws.apicep.com/busca-cep/api/cep.json?',
        'query' => [
          'code' => $parsedCep
        ],
        'expect_key' => 'code'
      ]
    ];
  }
}