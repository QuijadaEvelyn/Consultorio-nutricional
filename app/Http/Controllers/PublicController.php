<?php

namespace App\Http\Controllers;

use App\Models\SiteContent;

class PublicController extends Controller
{
    public function index()
    {
        $contents = SiteContent::all()->keyBy('key_name');
        return view('public.index', compact('contents'));
    }
}