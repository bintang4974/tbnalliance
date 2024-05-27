<?php

namespace App\Http\Controllers;

use App\Models\Choose;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ChooseController extends Controller
{
    public function index(int $pageId)
    {
        $title = "Choose";
        $page = Page::findOrFail($pageId);
        $chooseImage = Choose::where('page_id', $pageId)->get();

        return view('choose.index', compact('title', 'page', 'chooseImage'));
    }

    public function store(Request $request, int $pageId)
    {
        $request->validate([
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $page = Page::findOrFail($pageId);

        $imageData = [];
        if ($files = $request->file('image')) {
            foreach ($files as $key => $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $key . '-' . time() . '-' . $extension;

                $path = 'uploads/page/';
                $file->move($path, $filename);

                $imageData[] = [
                    'page_id' => $page->id,
                    'image' => $path . $filename
                ];
            }
        }

        Choose::insert($imageData);
        return redirect()->back()->with('success', 'Image berhasil ditambahkan.');
    }

    public function destroy(int $chooseImageId)
    {
        $chooseImage = Choose::findOrFail($chooseImageId);

        if (File::exists($chooseImage->image)) {
            File::delete($chooseImage->image);
        }

        $chooseImage->delete();

        return redirect()->back()->with('success', 'Image berhasil ditambahkan.');
    }
}
