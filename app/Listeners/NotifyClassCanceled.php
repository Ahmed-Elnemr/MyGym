<?php

namespace App\Listeners;

use App\Events\ClassCancel;
use App\Models\ScheduledClass;
use App\Jobs\NotifyClassCanceledJob;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CalssCancelNotification;

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
        $members = $event->scheduledClass->member()->get();
        // $members->each(function ($user) use ($details) {
        //     Mail::to($user)->send(new ClassCancelMail($details));
        // });
        NotifyClassCanceledJob::dispatch($details, $members);

    }
}
