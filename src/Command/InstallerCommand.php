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
    protected $signature = 'resource:install {resource} ';

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

        if(!in_array($this->resourceName, config('uncle.installable'))){
            $this->error($this->resourceName  . ' is not an available resource');
            return;
        }

        $this->resourcePath = app_path('Http'.DIRECTORY_SEPARATOR.'Resources'). DIRECTORY_SEPARATOR. $this->resourceName;

        if (\File::exists($this->resourcePath)) {
            $this->error($this->resourceName  . ' resource already exists');
            return;
        }

        \File::makeDirectory($this->resourcePath);
        \File::copyDirectory(__DIR__.'/../Resources/'.$this->resourceName,$this->resourcePath);

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
}
