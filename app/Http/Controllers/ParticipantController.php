<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Participant";

        $participant = Participant::all();
        return view('participant.index', compact('title', 'participant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Participant";
        $ticket = Ticket::all();

        return view('participant.create', compact('title', 'ticket'));
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
            'email' => 'required|email|unique:participant,email',
            'telp' => 'required|numeric',
            'notes' => 'required',
            'afiliate' => 'required',
            'ticket_id' => 'required',
        ]);

        Participant::create([
            'name' => $request->name,
            'email' => $request->email,
            'telp' => $request->telp,
            'notes' => $request->notes,
            'afiliate' => $request->afiliate,
            'ticket_id' => $request->ticket_id,
        ]);

        return redirect()->route('participant.index')->with('success', 'Speaker berhasil ditambahkan.');
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
        $title = "Edit Ticket";
        $participant = Participant::find($id);
        $ticket = Ticket::all();

        return view('participant.edit', compact('title', 'participant', 'ticket'));
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
            'email' => 'required|email',
            'telp' => 'required|numeric',
            'notes' => 'required',
            'afiliate' => 'required',
            'ticket_id' => 'required',
        ]);

        $participant = Participant::find($id);

        $participant->update([
            'name' => $request->name,
            'email' => $request->email,
            'telp' => $request->telp,
            'notes' => $request->notes,
            'afiliate' => $request->afiliate,
            'ticket_id' => $request->ticket_id,
        ]);

        return redirect()->route('participant.index')->with('success', 'Speaker berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Participant::find($id)->delete();

        return redirect()->route('participant.index')->with('success', 'program berhasil dihapus.');
    }
}
