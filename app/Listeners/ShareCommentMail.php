<?php

namespace App\Listeners;

use App\Events\CommentEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Commentchapter;
use App\Mail\NewCommentMail;
use Mail;

class ShareCommentMail
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\CommentEvent  $event
     * @return void
     */
    public function handle(CommentEvent $event)
    {
        $chapter = $event->publication;

        $author = $event->author;
        
        $owner = $event->owner;
        
        $comment = Commentchapter::where('chapter_id', $chapter->id)->where('user_id', $author->id)->get();

        Mail::to($owner)->send(
            new NewCommentMail($author->name . ' fez um novo comentário em ' . $chapter->title, $comment[0]->content, $author)
        );
    }
}
