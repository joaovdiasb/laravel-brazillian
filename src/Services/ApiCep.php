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
    if (strlen(preg_replace('/[^0-9]/', '', $cep)) !== 8) {
      throw CepException::invalidLength($cep);
    }

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

      if (optional($body)[$service['expectKey']] === $this->cep) {
        return $body;
      } elseif (optional($client)->getStatusCode()) {
        throw CepException::notFound($this->cep);
      }
    }
  }

  private function services(): array
  {
    $cep = preg_replace('/[^0-9]/', '', $this->cep);

    return [
      [
        'baseUrl' => 'viacep.com.br/ws/',
        'url' => "{$cep}/json/",
        'expectKey' => 'cep'
      ],
      [
        'baseUrl' => 'ws.apicep.com/busca-cep/api/cep.json?',
        'query' => [
          'code' => $cep
        ],
        'expectKey' => 'code'
      ]
    ];
  }
}