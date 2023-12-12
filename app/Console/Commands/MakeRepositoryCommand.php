<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * The filesystem instance.
     */
    protected $files;

    /**
     * Initialize the command.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $model = $this->option('model');
        $interface = $this->ask('What is the interface name?');

        // Validate the model name.
        $this->validateModelName($model);

        // Validate the interface name.
        $this->validateInterfaceName($interface);

        // Create the repository class.
        $this->createRepository($name, $model, $interface);
    }

    /**
     * Validate the model name.
     */
    protected function validateModelName(string $model): void
    {
        if (!$this->files->exists(app_path("Models/{$model}.php"))) {
            $this->error("The model {$model} does not exist.");

            return;
        }
    }

    /**
     * Validate the interface name.
     */
    protected function validateInterfaceName(string $interface): void
    {
        if (!$this->files->exists(app_path("Contracts/Repositories/{$interface}.php"))) {
            $this->error("The interface {$interface} does not exist.");

            return;
        }
    }

    /**
     * Create the repository class.
     */
    protected function createRepository(string $name, string $model, string $interface): void
    {
        // If there is a directory in the name, create the directory and the repository class.
        if (str_contains($name, '/')) {
            $directories = explode('/', $name);
            $className = array_pop($directories);
            $path = 'Repositories';

            foreach ($directories as $directory) {
                $path .= "/{$directory}";
                $this->files->ensureDirectoryExists(app_path($path));
            }

            $this->files->put(app_path("{$path}/{$className}.php"), $this->buildRepository($name, $model, $interface));
            $this->info("Repository {$name} created successfully.");
        } else {
            $this->files->put(app_path("Repositories/{$name}.php"), $this->buildRepository($name, $model, $interface));
            $this->info("Repository {$name} created successfully.");
        }
    }

    /**
     * Build the repository class.
     */
    protected function buildRepository(string $name, string $model, string $interface): string
    {
        $stub = $this->files->get(base_path('stubs/repository.stub'));

        $stub = str_replace('{{ name }}', $name, $stub);
        $stub = str_replace('{{ model }}', $model, $stub);
        $stub = str_replace('{{ interface }}', $interface, $stub);
        $stub = str_replace('{{ namespace }}', $this->getNamespace($name), $stub);
        $stub = str_replace('{{ class }}', $this->getClass($name), $stub);

        return $stub;
    }

    /**
     * Get the namespace.
     */
    protected function getNamespace(string $name): string
    {
        if (str_contains($name, '/')) {
            $directories = explode('/', $name);
            $namespace = 'App\\Repositories';

            foreach ($directories as $directory) {
                if ($directory === end($directories)) {
                    break;
                }
                $namespace .= "\\{$directory}";
            }

            return $namespace;
        }

        return 'App\\Repositories';
    }

    /**
     * Get the class name.
     */
    protected function getClass(string $name): string
    {
        if (str_contains($name, '/')) {
            $name = explode('/', $name)[count(explode('/', $name)) - 1];
        }

        return $name;
    }
}