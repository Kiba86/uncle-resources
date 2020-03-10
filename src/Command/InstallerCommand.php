<?php

namespace UncleProject\UncleResources\Command;

use UncleProject\UncleLaravel\Classes\BaseCommand;

class InstallerCommand extends BaseCommand
{

    protected $resourceName;
    protected $resourcePath;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resource:install {resource} {--force : force to remove and reinstall}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install a uncle resource in project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $names = $this->resolveResourceName($this->argument('resource'));
        $this->resourceName = $names['plural'];

        if(!array_key_exists($this->resourceName, config('uncle.installable'))){
            $this->error($this->resourceName  . ' is not an available resource');
            return;
        }

        $this->resourcePath = app_path('Http'.DIRECTORY_SEPARATOR.'Resources'). DIRECTORY_SEPARATOR. $this->resourceName;

        if ($this->option('force')) {
            \File::deleteDirectory($this->resourcePath);
        }

        if (\File::exists($this->resourcePath)) {
            $this->error($this->resourceName  . ' resource already exists! Use --force option to override the current Resource');
            return;
        }

        \File::makeDirectory($this->resourcePath);
        \File::copyDirectory(__DIR__.'/../Resources/'.$this->resourceName, $this->resourcePath);

        $this->renameMigrations();

        $this->writeInFile(
            config_path('app.php'),
            '//Add Resource - Uncle Comment (No Delete)',
            $this->compileStub(
                ['{resourceName}'],
                [$this->resourceName],
                __DIR__.'/stubs/AddResourcePath.stub')
        );

        $this->info("Resource {$this->resourceName} installed successfully");
    }

    private function renameMigrations(){

        $migrations = \File::allFiles($this->resourcePath.DIRECTORY_SEPARATOR.'Database'.DIRECTORY_SEPARATOR.'migrations');

        foreach ($migrations as $migration) {
            \File::move($migration->getPathname(),$migration->getPath().'/'.date("Y_m_d_His").$migration->getFilename());
        }

    }
}
