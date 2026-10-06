<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    public function index()
    {
        $contents = SiteContent::all();
        return view('admin.site_contents.index', compact('contents'));
    }

    public function update(Request $request, SiteContent $siteContent)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $siteContent->update($validated);

        return back()->with('success', 'Sección de publicidad/información actualizada.');
    }
}