<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Program";

        $program = Program::all();
        return view('program.index', [
            'title' => $title,
            'program' => $program
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Program";

        return view('program.create', compact('title'));
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
            'name' => 'required',
            'desc' => 'required',
            'time' => 'required',
            'place' => 'required',
            'speaker' => 'required',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->poster->extension();
        $request->poster->move(public_path('images'), $imageName);

        Program::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'time' => $request->time,
            'place' => $request->place,
            'speaker' => $request->speaker,
            'poster' => $imageName,
        ]);

        return redirect()->route('program.index')->with('success', 'Speaker berhasil ditambahkan.');
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
        $title = "Edit Program";
        $program = Program::find($id);

        return view('program.edit', compact('title', 'program'));
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
            'name' => 'required',
            'desc' => 'required',
            'time' => 'required',
            'place' => 'required',
            'speaker' => 'required',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $program = Program::find($id);
        $imageName = $program->poster;

        if ($request->hasFile('poster')) {
            $imageName = time() . '.' . $request->poster->extension();
            $request->poster->move(public_path('images'), $imageName);
        }

        $program->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'time' => $request->time,
            'place' => $request->place,
            'speaker' => $request->speaker,
            'poster' => $imageName,
        ]);

        return redirect()->route('program.index')->with('success', 'Speaker berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $program = Program::find($id);

        $photoPath = public_path('images/' . $program->poster);
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
        $program->delete();

        return redirect()->route('program.index')->with('success', 'program berhasil dihapus.');
    }
}
