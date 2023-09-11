<?php

namespace App\Http\Controllers;

use App\Models\ScheduledClass;
use Symfony\Component\HttpFoundation\Request;

class BookingController extends Controller
{
    public function create()
    {
        $scheduledClasses = ScheduledClass::upcoming()
            ->with('classType', 'instructor')
            ->notBooked()
            ->oldest('date_time')->get();
        return view('member.book')->with('scheduledClasses', $scheduledClasses);
    }
    ##
    public function store(Request $request)
    {
        auth()->user()->bookings()->attach($request->scheduled_class_id);

        return redirect()->route('booking.index');
    }
    ##
    public function index()
    {
        $bookings = auth()->user()->bookings()->upcoming()->get();
        // dd($bookings);

        return view('member.upcoming')->with('bookings', $bookings);
    }
    ##
    public function destroy(int $id)
    {
        auth()->user()->bookings()->detach($id);

        return redirect()->route('booking.index');
    }
}