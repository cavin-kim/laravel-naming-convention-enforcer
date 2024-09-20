<?php

namespace Vendor\KPhiri;

use Illuminate\Support\ServiceProvider;

class KPhiriServiceProvider extends ServiceProvider
{
    protected $commands = [
        \Vendor\KPhiri\Console\Commands\EnforceNamingConventions::class,
    ];
    public function register()
    {
        $this->commands($this->commands);
    }

    public function boot()
    {
        $enforcer = new NamingConventionEnforcer();
        $enforcer->checkModelsAndControllers();
    }
}
