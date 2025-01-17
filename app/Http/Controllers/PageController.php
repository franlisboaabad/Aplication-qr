<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //

    public function home()
    {
        $autos = Auto::paginate(6);
        return view('auth.login', compact('autos'));
    }

    public function auto($slug)
    {
        $auto = Auto::where('slug', $slug)->firstOrFail();
        return view('auto', compact('auto'));
        // dd($auto);
    }
}
