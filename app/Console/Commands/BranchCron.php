<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\BranchController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BranchCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'branch:cron';

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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // syncRequest
        Log::info("Start Fetching Branch Master ... ");
            $call = new BranchController();
            $call->syncRequest();
        Log::info("End of Fetching Branch Master ... :)");

    }
}