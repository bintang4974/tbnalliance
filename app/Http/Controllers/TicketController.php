<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Ticket";

        $ticket = Ticket::all();
        return view('ticket.index', compact('title', 'ticket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Ticket";
        $program = Program::all();

        return view('ticket.create', compact('title', 'program'));
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
            'no_ticket' => 'required',
            'place' => 'required',
            'date' => 'required',
            'type' => 'required',
            'program_id' => 'required',
        ]);

        Ticket::create([
            'no_ticket' => $request->no_ticket,
            'place' => $request->place,
            'date' => $request->date,
            'type' => $request->type,
            'program_id' => $request->program_id,
        ]);

        return redirect()->route('ticket.index')->with('success', 'Speaker berhasil ditambahkan.');
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
        $ticket = Ticket::find($id);
        $program = Program::all();

        return view('ticket.edit', compact('title', 'ticket', 'program'));
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
            'no_ticket' => 'required',
            'place' => 'required',
            'date' => 'required',
            'type' => 'required',
            'program_id' => 'required',
        ]);

        $ticket = Ticket::find($id);

        $ticket->update([
            'no_ticket' => $request->no_ticket,
            'place' => $request->place,
            'date' => $request->date,
            'type' => $request->type,
            'program_id' => $request->program_id,
        ]);

        return redirect()->route('ticket.index')->with('success', 'Speaker berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ticket::find($id)->delete();

        return redirect()->route('program.index')->with('success', 'program berhasil dihapus.');
    }
}
