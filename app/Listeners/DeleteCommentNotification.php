<?php

namespace App\Listeners;

use App\Events\DeleteComment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeleteCommentNotification
{
    /**
     * Checks what type the comment is and deletes the notifications pertaining to it
     *
     * @param  \App\Events\DeleteComment  $event
     * @return void
     */
    public function handle(DeleteComment $event)
    {
        $comment = $event->comment;

        if (isset($comment->chapter_id)) {
            DB::table('notifications')
                ->where('type', 'App\Notifications\CommentNotification')
                ->whereJsonContains('data', [
                    'chapter' => [
                        'id' => $comment->chapter_id
                    ]
                ])
                ->delete();
        }

        if (isset($comment->post_id)) {
            DB::table('notifications')
                ->where('type', 'App\Notifications\CommentNotification')
                ->whereJsonContains('data', [
                    'post' => [
                        'id' => $comment->post_id
                    ]
                ])
                ->delete();
        }
        
    }
}
