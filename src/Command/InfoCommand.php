<?php

namespace UncleProject\UncleResources\Command;

use UncleProject\UncleLaravel\Classes\BaseCommand;

class InfoCommand extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'uncle:resource-installer-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List of available uncle-resources';

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
        $this->info('List of available resources:');
        foreach(config('uncle.installable') as $resource => $info){
            $this->info($resource  . ': '.$info['description']);
        }
    }


}
