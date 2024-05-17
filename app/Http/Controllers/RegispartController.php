<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Program;
use App\Models\Regispart;
use Illuminate\Http\Request;

class RegispartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Register Participants";

        $regispart = Regispart::all();
        return view('regispart.index', compact('title', 'regispart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Register Participants";

        $participant = Participant::all();
        $program = Program::all();

        return view('regispart.create', compact('title', 'participant', 'program'));
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
            'participant_id' => 'required',
            'program_id' => 'required',
            'status' => 'required',
            'attendance' => 'required',
            'notes' => 'required',
        ]);

        Regispart::create([
            'participant_id' => $request->participant_id,
            'program_id' => $request->program_id,
            'status' => $request->status,
            'attendance' => $request->attendance,
            'notes' => $request->notes,
        ]);

        return redirect()->route('regispart.index')->with('success', 'Speaker berhasil ditambahkan.');
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
        $title = "Edit Register Participants";
        $regispart = Regispart::find($id);
        $program = Program::all();
        $participant = Participant::all();

        return view('regispart.edit', compact('title', 'regispart', 'program', 'participant'));
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
            'participant_id' => 'required',
            'program_id' => 'required',
            'status' => 'required',
            'attendance' => 'required',
            'notes' => 'required',
        ]);

        $regispart = Regispart::find($id);

        $regispart->update([
            'participant_id' => $request->participant_id,
            'program_id' => $request->program_id,
            'status' => $request->status,
            'attendance' => $request->attendance,
            'notes' => $request->notes,
        ]);

        return redirect()->route('regispart.index')->with('success', 'Speaker berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Regispart::find($id)->delete();

        return redirect()->route('regispart.index')->with('success', 'program berhasil dihapus.');
    }
}
