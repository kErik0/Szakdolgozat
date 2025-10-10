<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountDeleteNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Fiók törlés értesítés')
            ->greeting('Kedves ' . $notifiable->name . '!')
            ->line('Ezúton értesítünk, hogy a fiók törlésre került a rendszerből.')
            ->line('Ha nem te kezdeményezted a törlést, kérjük, lépj kapcsolatba az ügyfélszolgálattal.')
            ->salutation('Üdvözlettel, az Állásportál csapata');
    }
}