<?php

namespace Joaovdiasb\LaravelBrazillian;

use Illuminate\Support\ServiceProvider;
use Joaovdiasb\LaravelBrazillian\Validation;

class LaravelBrazillianServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-brazillian.php', 'laravel-brazillian');

        $this->publishConfig();

        $this->registerRules();
    }

    private function registerRules()
    {
        $ruleMessages = $this->ruleMessages();

        $this->app['validator']->resolver(function ($translator, $data, $rules, $messages, $attributes) use ($ruleMessages) {
            $messages += $ruleMessages;

            return new Validation($translator, $data, $rules, $messages, $attributes);
        });
    }

    private function ruleMessages()
    {
        return [
            'cnpj' => 'CNPJ inválido.',
            'cpf' => 'CPF inválido.',
            'cpf_cnpj' => 'CPF ou CNPJ inválido.',
            'cep' => 'CEP inválido.',
            'uf' => 'UF inválido.',
            'telefone' => 'Telefone inválido.',
            'telefone_com_ddd' => 'Telefone com DDD inválido.',
            'telefone_com_codigo' => 'Telefone com código e DDD inválido.',
            'celular' => 'Celular inválido.',
            'celular_com_ddd' => 'Celular com DDD inválido.',
            'celular_com_codigo' => 'Celular com código e DDD inválido.',
            'telefone_celular' => 'Telefone inválido.',
            'telefone_celular_com_ddd' => 'Telefone com DDD inválido.',
            'telefone_celular_com_codigo' => 'Telefone com código e DDD inválido.',
            'formato_cnpj' => 'Formato do CNPJ inválido.',
            'formato_cpf' => 'Formato do CPF inválidoF.',
            'formato_cpf_cnpj' => 'Formato do CPF ou CNPJ inválido.',
            'formato_cep' => 'Formato do CEP inválido.',
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register facade
        $this->app->singleton('laravel-brazillian', function () {
            return new LaravelBrazillian;
        });
    }

    /**
     * Publish Config
     *
     * @return void
     */
    public function publishConfig()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-brazillian.php' => config_path('laravel-brazillian.php'),
            ], 'config');
        }
    }
}
