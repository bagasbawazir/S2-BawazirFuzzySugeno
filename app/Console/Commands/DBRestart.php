<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DBRestart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:restart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'do wipe, migration, seeding in 1 command';

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
        $this->call('db:wipe');
        $this->call('migrate');
        $this->call('db:seed');
    }
}
