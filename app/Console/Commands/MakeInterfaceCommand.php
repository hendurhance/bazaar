<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeInterfaceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new interface class';

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

        // Validate the interface name.
        $this->validateInterfaceName($name);

        // Create the interface.
        $this->createInterface($name);
    }

    /**
     * Validate the interface name.
     */
    protected function validateInterfaceName(string $name): void
    {
        if (! Str::endsWith($name, 'Interface')) {
            $this->error('The interface name must end with "Interface"');
            return;
        }
    }

    /**
     * Create the interface.
     */
    protected function createInterface(string $name): void
    {
        // If there is a directory in the name, create the directory and the interface .
        if (str_contains($name, '/')) {
            $directory = explode('/', $name)[0];

            $this->files->ensureDirectoryExists(app_path("Contracts/{$directory}"));

            $this->files->put(app_path("Contracts/{$name}.php"), $this->buildInterface($name));

            $this->info("The interface {$name} has been created.");
            return;
        }

        // Create the interface.
        $this->files->put(app_path("Contracts/{$name}.php"), $this->buildInterface($name));

        $this->info("The interface {$name} has been created.");
    }

    /**
     * Build the interface.
     */
    protected function buildInterface(string $name): string
    {
        $stub = $this->files->get(base_path('stubs/interface.stub'));
        
        $stub = str_replace('{{ namespace }}', $this->getNamespace($name), $stub);
        $stub = str_replace('{{ interface }}', $this->getInterfaceName($name), $stub);

        return $stub;
    }

    /**
     * Get the namespace.
     */
    protected function getNamespace(string $name): string
    {
        $namespace = 'App\Contracts';

        if (str_contains($name, '/')) {
            $namespace .= '\\' . explode('/', $name)[0];
        }

        return $namespace;
    }

    /**
     * Get the interface name.
     */
    protected function getInterfaceName(string $name): string
    {
        return explode('/', $name)[1];
    }
     
}
