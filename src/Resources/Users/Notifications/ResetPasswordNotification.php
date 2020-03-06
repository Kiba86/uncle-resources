<?php

namespace App\Http\Resources\Users\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $user) {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail( $notifiable ) {
        if (in_array('customer', $this->user->getRoleNames()->toArray())) {
            $link = config("app.url")."/#/password-reset?token=" . $this->token;
        } else if (in_array('admin', $this->user->getRoleNames()->toArray())) {
            $link = config("app.url")."/admin/#/password-reset?token=" . $this->token;
        }
        //$link = "http://localhost:8081/#/password-reset?token=" . $this->token;
        return ( new MailMessage )
            ->from(config('mail.from.address'))
            ->subject( 'Changer le mot de passe' )
            ->markdown('mails.resetPassword', ['link' => $link]);
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
}
