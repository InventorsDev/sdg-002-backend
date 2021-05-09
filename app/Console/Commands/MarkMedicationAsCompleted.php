<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\MarkMedicationAsCompleted  as MarkMedicationAsCompletedJob;

class MarkMedicationAsCompleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mark:medication-completed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark medication status to completed';

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
        return MarkMedicationAsCompletedJob::dispatch();
    }
}
