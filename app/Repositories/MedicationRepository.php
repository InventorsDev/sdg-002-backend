<?php
namespace App\Repositories;

use App\Enums\Status;
use App\Models\Medication;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\MedicationReminder;
use App\Contracts\MedicationRepository as MedicationRepositoryContract;

class MedicationRepository extends BaseRepository implements MedicationRepositoryContract
{
    public function __construct()
    {
        
    }

    public function storeMedication($data): Model
    {
        $data = (object) $data;
        $user = auth()->user();
        $medication = $user->medications()->create([
            'drug_name' => $data->drug_name,
            'hours_per_dosage' => $data->hours_per_dosage,
            'no_of_days' => $data->no_of_days,
            'dosage_started_at' => $data->dosage_started_at,
            'dosage'    => $data->dosage, 
            'status' => Status::PENDING,
        ]);

        $medication = $this->createReminderNotification($medication);

        return $medication;
    }

    public function getMedicationById($id) : Model
    {
        return Medication::find($id);
    }

    private function createReminderNotification($medication) : Model
    {
        $dosageHour = $medication->hours_per_dosage;
        $dosageDays = $medication->no_of_days;
        $dosageStartedAt = $medication->dosage_started_at->toImmutable();
        
        $end = $dosageStartedAt->addDays($dosageDays);

        $reminderTimeStamps = [];

        while ($dosageStartedAt <= $end) {
            $reminderTimeStamps[] = $dosageStartedAt->toIsoString(); 
            $notifiedAt = $dosageStartedAt->toIsoString(); 
            auth()->user()->notify( (new MedicationReminder($medication, $notifiedAt))->delay([
                'firebase' => $dosageStartedAt,
                'mail' => $dosageStartedAt
            ]) ); 

            $dosageStartedAt = $dosageStartedAt->addHours($dosageHour);
        }

        $medication->dosage_ends_at = collect($reminderTimeStamps)->last();
        $medication->Save();


        return $medication;
    }

    public function getMedicationReminders(int $medicationId = null) : array
    {
        $user = auth()->user();

        if(is_null($medicationId)){
            $notifications = $user->notifications()->where([
                ['type', MedicationReminder::class],
            ])->get();
        }
        else{
            $notifications = $user->notifications()->where([
                ['type', MedicationReminder::class],
                ['data->medication_id', $medicationId]
            ])->get();
        }
        



        $upcomingNotifications = $notifications->filter( function ($notification) {
            return Carbon::parse($notification->data['to_be_taken_at']) > now();
        })->sortBy(fn ($notification, $key) => $notification->data['to_be_taken_at'])
        ->values()->toArray();

        $pastNotifications = $notifications->filter( function ($notification) {
            return Carbon::parse($notification->data['to_be_taken_at']) < now();
        })->sortBy(fn ($notification, $key) => $notification->data['to_be_taken_at'])
        ->values()->toArray();


        return compact('upcomingNotifications', 'pastNotifications');

    }

    public function markNotificationAsRead($notificationId) : void
    {       
        $user = auth()->user();
        $notification = $user->unreadNotifications()->where('id', $notificationId)->first();
        if(!is_null($notification)){
            $notification->update(['read_at' => now()]);
        }
    }

    public function markNotificationAsCompleted($notificationId) : void
    {       
        $user = auth()->user();
        $notification = $user->notifications()->where('id', $notificationId)->first();
        if(!is_null($notification)){
            $notification->update(['data->completed' => true]);
        }
    }
}