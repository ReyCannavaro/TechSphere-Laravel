<?php

namespace App\Http\Controllers;

use App\Models\Gadget;
use Illuminate\Http\Request;

class GadgetController extends Controller
{

    public function index()
    {

    }

    public function show(string $slug)
    {
        $gadget = Gadget::where('slug', $slug)->firstOrFail();

        $ratings = $gadget->ratings()->with('user')->get();

        return view('gadgets.show', compact('gadget', 'ratings'));
    }

    // ... method lain seperti create, store, edit, update, destroy jika diperlukan nanti untuk admin
}