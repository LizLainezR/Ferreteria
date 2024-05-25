<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the laravel.log file';

    /**
     * Execute the console command.
     */


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        file_put_contents(storage_path('logs/laravel.log'), '');
        $this->info('Log file has been cleared!');
    }
}
