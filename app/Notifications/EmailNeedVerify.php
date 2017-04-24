<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class EmailNeedVerify extends Notification
{
    /**
     * The user.
     *
     * @var User
     */
    public $user;

    /**
     * Create a notification instance.
     *
     * @param  string  $user
     * @return void
     */
    public function __construct(User $user)
    {
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Hi, ' . $this->user . '! Thanks for joining us.')
            ->line('We need to verify your email address.')
            ->action('Click to verify', route('auth.verify_email', ['code' => $this->user->emailVerification->code]))
            ->line('If you did not signup with us, no further action is required.');
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
