<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Log;
use App\Contracts\MedicationRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicationResource extends JsonResource
{

    

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array = parent::toArray($request);
        $array['to_be_taken_at'] = $this->nextToBeTakenAt($this->id);
        return $array;
    }

    public function nextToBeTakenAt($id)
    {

        $medicationRepository = app(MedicationRepository::class);
        $reminders = $medicationRepository->getMedicationReminders($id);
        
        if(count($reminders['upcomingNotifications'])){
            [$nextReminder] = $reminders['upcomingNotifications'];
            return $nextReminder['data']['to_be_taken_at'];
        }
        if(count($reminders['pastNotifications'])){
            $lastReminder = collect($reminders['pastNotifications'])->last();
            return $lastReminder['data']['to_be_taken_at'];
        }
        
    }

}
