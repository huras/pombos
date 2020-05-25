<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PombalController extends Controller
{
    public function create()
    {
        return view('Pombal.create');
    }
}
