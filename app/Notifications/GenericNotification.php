<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GenericNotification extends Notification
{
    use Queueable;

    protected $actor;
    protected $message;
    protected $url;
    protected $type;

    /**
     * Create a new notification instance.
     */
    public function __construct($actor, $message, $url = '#', $type = null)
    {
        $this->actor = $actor;
        $this->message = $message;
        $this->url = $url;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'actor_id' => $this->actor->id,
            'actor_name' => $this->actor->full_name,
            'actor_image' => $this->actor->image,
            'message' => $this->message,
            'url' => $this->url,
            'type' => $this->type,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
