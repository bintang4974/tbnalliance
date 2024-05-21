<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Participant;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Experience";

        $experience = Experience::all();
        return view('experience.index', compact('title', 'experience'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Experience";
        $participant = Participant::all();

        return view('experience.create', compact('title', 'participant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'desc' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'participant_id' => 'required',
        ]);

        $imageName = time() . '.' . $request->picture->extension();
        $request->picture->move(public_path('images'), $imageName);

        Experience::create([
            'desc' => $request->desc,
            'picture' => $imageName,
            'participant_id' => $request->participant_id,
        ]);

        return redirect()->route('experience.index')->with('success', 'Speaker berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Experience";
        $experience = Experience::find($id);
        $participant = Participant::all();

        return view('experience.edit', compact('title', 'experience', 'participant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'desc' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'participant_id' => 'required',
        ]);

        $experience = Experience::find($id);
        $imageName = $experience->poster;

        if ($request->hasFile('picture')) {
            $imageName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('images'), $imageName);
        }

        $experience->update([
            'desc' => $request->desc,
            'picture' => $imageName,
            'participant_id' => $request->participant_id,
        ]);

        return redirect()->route('experience.index')->with('success', 'Speaker berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $experience = Experience::find($id);

        $photoPath = public_path('images/' . $experience->picture);
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
        $experience->delete();

        return redirect()->route('experience.index')->with('success', 'experience berhasil dihapus.');
    }
}
