<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Greetings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:greetings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description here here';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Hello, world! greetings');
    }
}
