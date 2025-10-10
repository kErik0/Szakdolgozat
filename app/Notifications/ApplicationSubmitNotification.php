<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationSubmitNotification extends Notification
{

    protected $jobTitle;
    /**
     * Create a new notification instance.
     */
    public function __construct($application)
    {
        $this->jobTitle = $application->job->title;
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
            ->subject('Sikeres jelentkezés')
            ->greeting('Kedves ' . $notifiable->name . '!')
            ->line("Sikeresen jelentkeztél a(z) '{$this->jobTitle}' állásra az Állásportálon.")
            ->line('Köszönjük, hogy használod az oldalunkat!')
            ->salutation('Üdvözlettel, az Állásportál csapata.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
