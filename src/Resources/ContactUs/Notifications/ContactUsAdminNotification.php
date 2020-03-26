<?php

namespace App\Http\Resources\ContactUs\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactUsAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $from;
    protected $object;
    protected $text;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from, $object, $text) {

        $this->from = $from;
        $this->object = $object;
        $this->text = $text;
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

        return ( new MailMessage )
            ->from($this->from)
            ->subject( $this->object )
            ->markdown('ContactUsAdminMail', [ 'from' => $this->from, 'object' => $this->object, 'text' => $this->text]);
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