<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeachController extends Controller
{
    public function index()
    {
        return view('teach');
    }
}
