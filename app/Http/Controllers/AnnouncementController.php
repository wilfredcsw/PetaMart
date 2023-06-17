<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::all();
        return view('pages.announcement',compact('announcements'));
    }

    /**
     * Store a newly created announcement in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // dd($request);
        // Validate the form data
        $validated = Announcement::create([
            'user_id' => Auth::user()->id,
            'AnnouncementTitle' => $request->AnnouncementTitle,
            'AnnouncementDate' => $request->AnnouncementDate,
            'AnnouncementDesc' => $request->AnnouncementDesc,
        ]);

        // // Create a new announcement with the validated data
        // Announcement::create($validatedData);

        // Redirect back to the announcement index page with a success message
        return redirect()->route('pages.announcement')->with('success', 'Announcement added successfully.');
    }

    /**
     * Show the form for editing the specified announcement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('pages.announcement.edit', compact('announcements'));
    }

    /**
     * Update the specified announcement in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Announcement $announcement)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'AnnouncementTitle' => 'required',
            'AnnouncementDate' => 'required|date',
            'AnnouncementDesc' => 'required',
        ]);

        // Find the announcement and update it with the validated data
        $announcement = Announcement::findOrFail($announcement);
        $announcement->update($validatedData);

        // Redirect back to the announcement index page with a success message
        return redirect()->route('pages.announcement')->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified announcement from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        // Redirect back to the announcement index page with a success message
        return redirect(route('pages.announcement'));
    }

}
