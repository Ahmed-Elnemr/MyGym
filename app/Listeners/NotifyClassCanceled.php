<?php

namespace App\Listeners;

use App\Events\ClassCancel;
use App\Mail\ClassCancelMail;
use App\Models\ScheduledClass;
use Illuminate\Support\Facades\Mail;

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
        $ScheduledClass = $event->scheduledClass;
        $className = $ScheduledClass->classType->name;
        $dateTime = $ScheduledClass->date_time;

        $details = compact('className', 'dateTime');
        $members = $event->scheduledClass->member();
        $members->each(function ($user) use ($details) {
            Mail::to($user)->send(new ClassCancelMail($details));
        });

    }
}