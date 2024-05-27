<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Page";
        $page = Page::all();

        return view('page.index', compact('title', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Page";

        return view('page.create', compact('title'));
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
            'title' => 'required',
            'desc' => 'required',
            'about' => 'required',
            'mission' => 'required',
        ]);

        Page::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'about' => $request->about,
            'mission' => $request->mission,
        ]);

        return redirect()->route('page.index')->with('success', 'Speaker berhasil ditambahkan.');
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
        $title = "Edit Page";
        $page = Page::find($id);

        return view('page.edit', compact('title', 'page'));
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
            'title' => 'required',
            'desc' => 'required',
            'about' => 'required',
            'mission' => 'required',
        ]);

        $page = Page::find($id);

        $page->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'about' => $request->about,
            'mission' => $request->mission,
        ]);

        return redirect()->route('page.index')->with('success', 'Speaker berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::find($id)->delete();

        return redirect()->route('page.index')->with('success', 'program berhasil dihapus.');
    }
}
