<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountLinked extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(User $user)
    {
        return (new MailMessage)
            ->line('Ho ! Ho ! Ho !')
            ->line('Bonjour, '.$user->first_name.',')
            ->line('J\'ai bien noté ton nom pour le Secret Santa de '.config('app.company_name').'.')
            ->line('Tu recevras très bientôt une missive avec le nom du collègue à qui tu devras faire un cadeau.')
            ->line('Merci et à très vite !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
