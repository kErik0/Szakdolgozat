<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationAcceptNotification extends Notification
{

    /**
     * Az elfogadott jelentkezés példánya.
     *
     * @var mixed
     */
    private $application;

    /**
     * Create a new notification instance.
     *
     * @param mixed $application
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
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('A jelentkezésed elfogadásra került')
            ->greeting('Kedves ' . $notifiable->name . '!')
            ->line('Örömmel értesítünk, hogy a jelentkezésed az alábbi pozícióra elfogadásra került: ' . $this->application->job->title)
            ->line('Gratulálunk, és hamarosan felvesszük veled a kapcsolatot a további lépésekkel kapcsolatban.')
            ->action('További állások megtekintése', 'http://127.0.0.1:8000/jobs')
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
            'status' => 'accepted',
        ];
    }
}