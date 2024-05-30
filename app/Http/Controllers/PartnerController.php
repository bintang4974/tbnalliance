<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{
    public function index(int $pageId)
    {
        $title = "Partner";
        $page = Page::findOrFail($pageId);
        $partnerImage = Partner::where('page_id', $pageId)->get();

        return view('partner.index', compact('title', 'page', 'partnerImage'));
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

        Partner::insert($imageData);
        return redirect()->back()->with('success', 'Image berhasil ditambahkan.');
    }

    public function destroy(int $partnerImageId)
    {
        $partnerImage = Partner::findOrFail($partnerImageId);

        if (File::exists($partnerImage->image)) {
            File::delete($partnerImage->image);
        }

        $partnerImage->delete();

        return redirect()->back()->with('success', 'Image berhasil ditambahkan.');
    }
}
