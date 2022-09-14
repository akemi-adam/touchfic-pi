<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class CommentNotification extends Notification
{
    use Queueable;

    private $author;

    private $publication;

    public function __construct(User $author, $publication)
    {
        $this->author = $author;
        $this->publication = $publication;
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

        $classes = [
            'App\Models\Chapter',
            'App\Models\Post',
        ];

        if ($this->publication instanceof $classes[0])  {

            return [
                'chapter' => [
                    'title' => $this->publication->title,
                    'id' => $this->publication->id,
                ],
                'author' => [
                    'name' => $this->author->name,
                    'avatar' => $this->author->avatar,
                    'id' => $this->author->id,
                ],
                'storie' => [
                    'title' => $this->publication->storie->title,
                    'id' => $this->publication->storie->id
                ],
            ];

        } else if ($this->publication instanceof $classes[1]) {

            return [
                'post' => [
                    'id' => $this->publication->id,
                ],
                'author' => [
                    'name' => $this->author->name,
                    'avatar' => $this->author->avatar,
                    'id' => $this->author->id,
                ]
            ];

        }

    }
}
