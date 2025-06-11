<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AnalyzeCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:analyze';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform static analysis and styling checks.';

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
        // Run Laravel Duster
        $this->info('Running Laravel Duster...');
        exec('/vendor/bin/duster lint');

        // Run PhpStan
        $this->info('Running PhpStan...');
        exec('/vendor/bin/phpstan analyse --level max');

        $this->info('Static analysis and styling checks completed.');
    }
}
