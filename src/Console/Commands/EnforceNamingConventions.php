<?php

namespace Vendor\KPhiri\Console\Commands;

use Illuminate\Console\Command;
use Vendor\KPhiri\NamingConventionEnforcer;

class EnforceNamingConventions extends Command
{
    protected $signature = 'naming:enforce';
    protected $description = 'Enforce naming conventions for models and controllers';

    public function handle()
    {
        $enforcer = new NamingConventionEnforcer();
        $enforcer->checkModelsAndControllers();
        $this->info('Naming conventions enforced successfully.');
    }
}
