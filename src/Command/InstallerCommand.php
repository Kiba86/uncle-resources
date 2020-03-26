<?php

namespace UncleProject\UncleResources\Command;

use UncleProject\UncleLaravel\Classes\BaseCommand;
use Illuminate\Support\Facades\Artisan;

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
        $this->resourceName = $this->argument('resource');

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

        foreach (config('uncle.installable.'.$this->resourceName.'.required') as $required){
            if (!\File::exists(app_path('Http'.DIRECTORY_SEPARATOR.'Resources'). DIRECTORY_SEPARATOR. $required)) {
                $this->error($this->resourceName  . " need resource $required to be installed!");
                return;
            }
        }

        \File::makeDirectory($this->resourcePath);
        \File::copyDirectory(__DIR__.'/../Resources/'.$this->resourceName, $this->resourcePath);

        $this->renameMigrations();

        $this->writeInFile(
            config_path('uncle.php'),
            '//Add Resource - Uncle Comment (No Delete)',
            $this->compileStub(
                ['{resourceName}'],
                [$this->resourceName],
                __DIR__.'/stubs/AddResourcePath.stub')
        );

        $postinstall = config('uncle.installable.'.$this->resourceName.'.postinstall');

        if(isset($postinstall)){
            if(isset($postinstall['commands'])){
                foreach($postinstall['commands'] as $command){
                    Artisan::call($command);
                    $this->info(Artisan::output());
                }
            }
        }

        $this->info("Resource {$this->resourceName} installed successfully");
    }

    private function renameMigrations(){

        if (\File::exists($this->resourcePath.DIRECTORY_SEPARATOR.'Database'))
        {
            $migrations = \File::allFiles($this->resourcePath.DIRECTORY_SEPARATOR.'Database'.DIRECTORY_SEPARATOR.'migrations');

            foreach ($migrations as $migration) {
                \File::move($migration->getPathname(),$migration->getPath().'/'.date("Y_m_d_His").$migration->getFilename());
            }
        }
    }
}
