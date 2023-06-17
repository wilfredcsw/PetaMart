<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Auth;



class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('pages.schedule', compact('schedules'));
    }

    /**
     * Store a newly created schedule in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //validate the form data
        // $validated = Schedule::create([
        //     'user_id' => Auth::user()->id,
        //     'ScheduleTitle' => $request->ScheduleTitle,
        //     'WorkingDate' => $request->WorkingDate,
        //     'WorkingTime' => $request->WorkingTime,
        //     'AssignUser' => $request->AssignUser,
        // ]);
        // Validate the form data
        $validatedData = $request->validate([
            'ScheduleTitle' => 'required|string|max:255',
            'WorkingDate' => 'required|date',
            'WorkingTime' => 'required|date_format:H:i',
            'AssignUser' => 'required|string|max:255',
        ]);

        // // Create a new schedule with the validated data
        Schedule::create($validatedData);

        // Redirect back to the schedule index page with a success message
        return redirect()->route('pages.schedule')->with('success', 'Schedule added successfully.');
    }

        /**
     * Remove the specified schedule from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        // Redirect back to the schedule index page with a success message
        return redirect(route('pages.schedule'));
    }






}
    
    