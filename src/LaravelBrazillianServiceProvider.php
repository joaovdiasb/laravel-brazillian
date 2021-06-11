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
            'formato_cnpj' => 'Formato inválido para CNPJ.',
            'formato_cpf' => 'Formato inválido para CPF.',
            'formato_cpf_cnpj' => 'Formato inválido para CPF ou CNPJ.',
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
