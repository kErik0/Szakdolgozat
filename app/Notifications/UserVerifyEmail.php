<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

class UserVerifyEmail extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', // a user guard-hoz tartozó route
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Email cím megerősítése') // magyar tárgy
            ->greeting('Kedves ' . $notifiable->name . '!') // magyar üdvözlés
            ->line('Kérjük, kattints az alábbi gombra az email címed megerősítéséhez.') // magyar sor
            ->action('Email cím megerősítése', $this->verificationUrl($notifiable))
            ->line('Ha nem te regisztráltál, ezt az üzenetet figyelmen kívül hagyhatod.')
            ->salutation('Üdvözlettel, az Állásportál csapata.');
    }
}