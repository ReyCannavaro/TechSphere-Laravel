<?php

namespace App\Http\Controllers;

use App\Models\Gadget;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $featuredGadgets = Gadget::where('is_featured', true)->latest()->take(2)->get();

        $recommendedGadgets = Gadget::where('is_featured', false)->latest()->take(8)->get();

        return view('home', compact('featuredGadgets', 'recommendedGadgets'));
    }
}