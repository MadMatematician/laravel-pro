<?php

namespace App\Console\Commands;

use App\Http\Controllers\RetrievePeoples;
use Illuminate\Console\Command;

class testRetrievePeoples extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $test = new RetrievePeoples();
        $test->peopleFromSource();
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
