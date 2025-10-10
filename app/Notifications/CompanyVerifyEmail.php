<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Messages\MailMessage;

class CompanyVerifyEmail extends VerifyEmail
{
    protected function verificationUrl($notifiable)
    {
        // A céges guardhoz tartozó route-ot használjuk:
        return URL::temporarySignedRoute(
            'company.verification.verify', // ez a web.php-ból jön
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
            ->subject('Erősítsd meg az email címedet')
            ->line('Kérjük, kattints az alábbi gombra az email címed megerősítéséhez.')
            ->action('Email megerősítése', $this->verificationUrl($notifiable))
            ->line('Ha nem te regisztráltál, nincs további teendőd.')
            ->salutation('Üdvözlettel, az Állásportál csapata.');
    }
}