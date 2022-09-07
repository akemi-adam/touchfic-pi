<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Storie;

class StorieLikeNotification extends Notification
{
    use Queueable;

    private $reader;

    private $storie;

    public function __construct(User $reader, Storie $storie)
    {
        $this->reader = $reader;
        $this->storie = $storie;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'reader_name' => $this->reader->name,
            'reader_avatar' => $this->reader->avatar,
            'reader_id' => $this->reader->id,
            'storie_title' => $this->storie->title,
            'storie_id' => $this->storie->id,
        ];
    }
}
