<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordChangedNotification extends Notification 
{

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Kedves ' . $notifiable->name . '!')
                    ->subject('Jelszóváltoztatás értesítés')
                    ->line('A jelszavad sikeresen megváltozott a portálon.')
                    ->line('Ha nem te végezted ezt a módosítást, kérjük, azonnal vedd fel a kapcsolatot a portál ügyfélszolgálatával.')
                    ->action('Kapcsolatfelvétel', 'mailto:info@allasportal.hu')
                    ->salutation('Üdvözlettel, az Állásportál csapata.');

    }
}