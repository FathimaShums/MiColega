<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\User;
use App\Models\Availability;
use App\Models\SessionRequest;
use Illuminate\Support\Facades\Auth;



class LearnController extends Controller
{
    // Method to show tutors and request form
  
// Method to handle session request submissions
// Method to handle session request submissions
public function requestSession(Request $request) {
    $request->validate([
        'tutor_id' => 'required|exists:users,id',
        'skill_id' => 'required|exists:skills,id',
    ]);

    $userId = Auth::id();
    $tutorId = $request->tutor_id;
    $skillId = $request->skill_id;

    // Create a new session request
    SessionRequest::create([
        'user_id' => $userId,
        'tutor_id' => $tutorId,
        'skill_id' => $skillId,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Your session request has been submitted.');
}
}
