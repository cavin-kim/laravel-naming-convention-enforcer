<?php

namespace Vendor\KPhiri;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class NamingConventionEnforcer
{
    protected $modelDirectory = 'app/Models';
    protected $controllerDirectory = 'app/Http/Controllers';

    public function checkModelsAndControllers()
    {
        // Step 1: Check model names and enforce singular naming
        $this->checkModelNames();

        // Step 2: Check controller names and enforce plural naming
        $this->checkControllerNames();

        // Step 3: Enforce proper route naming based on controllers
        $this->updateResourceRoutes();
    }

    protected function checkModelNames()
    {
        // Retrieve all model files from the directory
        $modelFiles = File::files(base_path($this->modelDirectory));

        foreach ($modelFiles as $modelFile) {
            $modelName = pathinfo($modelFile, PATHINFO_FILENAME);

            // If the model name is plural, rename it to singular
            if ($this->isPlural($modelName)) {
                $singularModelName = $this->toSingular($modelName);
                File::move(
                    base_path("{$this->modelDirectory}/{$modelName}.php"),
                    base_path("{$this->modelDirectory}/{$singularModelName}.php")
                );

                // Optionally update namespaces and class declarations in the file
                $this->updateFileNamespaceAndClass($modelFile->getRealPath(), $modelName, $singularModelName);
            }
        }
    }

    protected function checkControllerNames()
    {
        // Retrieve all controller files from the directory
        $controllerFiles = File::files(base_path($this->controllerDirectory));

        foreach ($controllerFiles as $controllerFile) {
            $controllerName = pathinfo($controllerFile, PATHINFO_FILENAME);

            if (!$this->isPlural($controllerName)) {
                $pluralControllerName = $this->toPlural($controllerName);
                File::move(
                    base_path("{$this->controllerDirectory}/{$controllerName}.php"),
                    base_path("{$this->controllerDirectory}/{$pluralControllerName}.php")
                );

                // Optionally update namespaces and class declarations in the file
                $this->updateFileNamespaceAndClass($controllerFile->getRealPath(), $controllerName, $pluralControllerName);
            }
        }
    }

    protected function updateResourceRoutes()
    {
        $controllerFiles = File::files(base_path($this->controllerDirectory));

        foreach ($controllerFiles as $controllerFile) {
            $controllerName = pathinfo($controllerFile, PATHINFO_FILENAME);

            if (str_ends_with($controllerName, 'Controller')) {
                $modelBaseName = substr($controllerName, 0, -10);
                $pluralModelName = $this->toPlural($modelBaseName);

                // Ensure the route is registered in the plural form
                Route::resource(strtolower($pluralModelName), $controllerName);
            }
        }
    }


    protected function isPlural($word)
    {
        // Basic plural detection using Laravel's Str helper
        return \Illuminate\Support\Str::plural($word) === $word;
    }

    protected function toSingular($word)
    {
        // Convert to singular using Laravel's Str helper
        return \Illuminate\Support\Str::singular($word);
    }

    protected function toPlural($word)
    {
        // Convert to plural using Laravel's Str helper
        return \Illuminate\Support\Str::plural($word);
    }

    protected function updateFileNamespaceAndClass($filePath, $oldName, $newName)
    {
        $fileContent = File::get($filePath);

        $fileContent = preg_replace("/class\s+$oldName/", "class $newName", $fileContent);
        File::put($filePath, $fileContent);
    }
}
