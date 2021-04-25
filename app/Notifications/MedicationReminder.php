<?php

namespace App\Notifications;

use App\Enums\Status;
use App\Models\Medication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MedicationReminder extends Notification implements ShouldQueue
{
    use Queueable;

    protected $medication;
    protected $notifiedAt;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Medication $medication, $notifiedAt)
    {
        $this->medication = $medication;
        $this->notifiedAt = $notifiedAt;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'medication_id' => $this->medication->id,
            'drug_name' => $this->medication->drug_name,
            'to_be_taken_at'  => $this->notifiedAt,
            'completed' => false,
        ];
    }
}
