<?php

namespace App\Http\Controllers;
use App\Models\Skill;
use Illuminate\Http\Request;

class TeachController extends Controller
{
    public function index()
    {
          // Fetch all skills along with the number of users who want to learn each skill
    $skills = Skill::withCount('users')->get();
    return view('teach', compact('skills'));
    }
 

}
