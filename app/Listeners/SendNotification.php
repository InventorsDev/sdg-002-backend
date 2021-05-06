<?php

namespace App\Listeners;

use App\Events\AlertEmergency;
use App\Notifications\AlertEmergencyNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Notification;

class SendNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AlertEmergency  $event
     * @return void
     */
    public function handle(AlertEmergency $event)
    {
        $contactEmails = $event->user->contacts->map( fn($contact) => $contact->email);
        Notification::route('mail', $contactEmails)->notify( new AlertEmergencyNotification($event->user));
    }
}
