<?php

namespace App\Listeners;

use App\Events\ClassCancel;

class NotifyClassCanceled
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassCancel $event): void
    {
        $scheduledClass = $event->scheduledClass;
        //
    }
}