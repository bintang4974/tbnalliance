<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Participant;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $title = "Experience";
        $experiences = Experience::all();
        return view('experience.index', compact('title', 'experiences'));
    }

    public function create()
    {
        $title = "Create Experience";
        $participants = Participant::all();
        return view('experience.create', compact('title', 'participants'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'desc' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'participant_id' => 'required|exists:participants,id', // Make sure participant_id exists in the participants table
        ]);

        // Process the image upload
        $imageName = time() . '.' . $request->picture->extension();
        $request->picture->move(public_path('images'), $imageName);

        // Create a new Experience model instance and save it to the database
        Experience::create([
            'desc' => $request->desc,
            'picture' => $imageName,
            'participant_id' => $request->participant_id,
        ]);

        // Redirect back to the index page with a success message
        return redirect()->route('experience.index')->with('success', 'Experience successfully added.');
    }

    public function edit($id)
    {
        $title = "Edit Experience";
        $experience = Experience::find($id);
        $participants = Participant::all();
        return view('experience.edit', compact('title', 'experience', 'participants'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'desc' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'participant_id' => 'required|exists:participants,id',
        ]);

        $experience = Experience::find($id);
        $imageName = $experience->picture;

        if ($request->hasFile('picture')) {
            $imageName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('images'), $imageName);
        }

        $experience->update([
            'desc' => $request->desc,
            'picture' => $imageName,
            'participant_id' => $request->participant_id,
        ]);

        return redirect()->route('experience.index')->with('success', 'Experience successfully updated.');
    }

    public function destroy($id)
    {
        $experience = Experience::find($id);

        $photoPath = public_path('images/' . $experience->picture);
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
        $experience->delete();

        return redirect()->route('experience.index')->with('success', 'Experience successfully deleted.');
    }
}
