<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewApplicationNotification extends Notification
{

    /**
     * Az alkalmazás példány tárolása.
     */
    private $application;

    /**
     * Új értesítés példány létrehozása.
     *
     * @param  mixed  $application
     * @return void
     */
    public function __construct($application)
    {
        $this->application = $application;
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
     * Az értesítés email reprezentációja.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Új jelentkezés érkezett!')
            ->greeting('Kedves ' . $notifiable->name . '!')            
            ->line('Új jelentkezés érkezett az egyik hirdetésedre: ' . $this->application->job->title)
            ->line('Pályázó neve: ' . $this->application->user->name)
            ->action('Jelentkezés megtekintése', route('jobs.applications', $this->application->job))
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
            'application_id' => $this->application->id,
            'job_id' => $this->application->job->id,
            'user_id' => $this->application->user->id,
        ];
    }
}
