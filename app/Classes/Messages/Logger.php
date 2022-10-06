<?php

namespace App\Classes\Messages;

use Auth, Log;

class Logger
{
    /**
     * Sends a log to a specific channel in a specific context
     * 
     * @param string $channel
     * @param string $level
     * @param string $message
     * 
     * @param void
     */
    public function log(string $channel, string $level, string $message) : void
    {
        $message = Auth::check() ? '[Action User: ' . Auth::id() . '] ' . $message : '[Action User: N/A] ' . $message;

        Log::channel($channel)->$level($message);
    }
}