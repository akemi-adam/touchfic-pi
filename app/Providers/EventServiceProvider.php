<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\{
    StorieLike, CommentEvent, UpdateNotification, DeleteStorie
};
use App\Listeners\{
    SendStorieLikeNotification, SendCommentNotification, UpdateLikeNotification, UpdateCommentNotification,
    RemoveStorieLikeNotification, RemoveCommentChapterNotification
};

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        StorieLike::class => [
            SendStorieLikeNotification::class,
        ],
        CommentEvent::class => [
            SendCommentNotification::class,
        ],
        UpdateNotification::class => [
            UpdateLikeNotification::class,
            UpdateCommentNotification::class,
        ],
        DeleteStorie::class => [
            RemoveStorieLikeNotification::class,
            RemoveCommentChapterNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
