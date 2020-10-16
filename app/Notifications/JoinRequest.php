<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class JoinRequest extends Notification
{
    use Queueable;
    private $joinRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($joinRequest)
    {
        //
        $this->joinRequest = $joinRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting($this->joinRequest['name'])
                    ->line($this->joinRequest['body'])
                    ->action($this->joinRequest['joinText'], $this->joinRequest['joinUrl'])
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable){

        $value = session('groupToJoin');

        return [
            'joinRequest' => 'You have a request to join your group',
            'from' => Auth::user()->name,
            "toGroup" => $value,
        ];

    }

    public function routeNotificationForMail($notification)
    {
        // Return email address only...
        return $this->email_address;
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
            'joinRequest_id' => $this->joinRequest['joinRequest_id']
        ];
    }
}
