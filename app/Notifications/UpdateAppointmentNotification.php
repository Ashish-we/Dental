<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateAppointmentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $appointment;
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        return (new MailMessage)
            ->line('Appointment has been Updated!.')
            ->line('Chief Complent : ' . $this->appointment->chief_complaint)
            ->line('Status : ' . $this->appointment->status)
            // ->action('view Appointment', url('/appointment/show/' . $this->appointment->id))
            ->line('Thank you for using our application!')
            ->salutation('Best regards, Sky Dental');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->appointment->id,
            'data' => ' Your Appointment : ' . $this->appointment->title . ' was Updated!'
        ];
    }
}
