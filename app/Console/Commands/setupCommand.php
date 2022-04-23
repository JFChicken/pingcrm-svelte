<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class setupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'setup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $this->output->title('setup');
      $this->output->info('This is going to run a few commands to help with setting up a new deployment ');
      exec('cp .env.example .env');
      $this->output->section(exec('php artisan key:gen'));

      $this->info(' build out new database and suchß');
      exec('touch database/database.sqlite');
      exec('php artisan migrate');

      $this->info('NPM or ui section');

      $this->info('i need to run npm install and build');

      exec('npm ci');
      exec('npm run dev');



      exec('php artisan test');
        return 0;
    }
}
