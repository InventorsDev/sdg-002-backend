<?php

namespace App\Jobs;

use App\Enums\Status;
use App\Models\Medication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarkMedicationAsCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $medicationIds = \Illuminate\Notifications\DatabaseNotification::where([['type', 'App\Notifications\MedicationReminder'], ['data->to_be_taken_at', '>=', now()]])
                                                        ->where()->get()->
                                                        pluck('data.medication_id')->
                                                        unique()->
                                                        toArray();

        Medication::whereIn('id', $medicationIds)->update(['status', Status::COMPLETED]);

    }
}
