<?php
namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\SkillRequest;
use Illuminate\Http\Request;
use App\Models\ProofDocument;
use App\Models\SessionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeachController extends Controller
{
    public function index()
    {
        $skills = Skill::withCount('users')->get();
        // Fetch session requests where the logged-in user is the tutor
        $sessionRequests = SessionRequest::where('tutor_id', Auth::id())->get();
        // Fetch approved skills for the logged-in user
    $approvedSkills = ProofDocument::where('user_id', Auth::id())
    ->where('status', 'approved')
    ->with('skill') // Eager load the associated skill
    ->get()
    ->pluck('skill'); // Extract only the skills
        return view('teach', compact('skills','sessionRequests','approvedSkills'));
    }

    public function submitSkillRequest(Request $request)
    {
        // Validate the request data
    $request->validate([
        'proof.*' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'skill_id' => 'required|array',
        'skill_id.*' => 'exists:skills,id',
        'proof' => 'required|array|min:1',
        'proof.required' => 'Please select at least one proof document to upload.',  // Custom message
        'proof.min' => 'You must select at least one proof document.',  // Custom message  // Ensure at least one proof is selected
    ]);

    // Create a new SkillRequest
    $skillRequest = SkillRequest::create([
        'user_id' => Auth::id(),
    ]);

    // Only loop through if there are proof files
    if ($request->hasFile('proof')) {
        foreach ($request->file('proof') as $index => $file) {
            $path = $file->store('proof_documents');

            ProofDocument::create([
                'user_id' => Auth::id(),
                'skill_id' => $request->skill_id[$index],
                'document_path' => $path,
                'skill_request_id' => $skillRequest->id,
            ]);
        }
    }

        return redirect()->route('teach')->with('success', 'Proof documents submitted successfully!');
    }
    public function updateSessionRequestStatus(Request $request, $id)
    {
        $sessionRequest = SessionRequest::findOrFail($id);

        // Ensure the logged-in user is the tutor for this request
        if ($sessionRequest->tutor_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the status input
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        // Update the status
        $sessionRequest->status = $request->status;
        $sessionRequest->save();

        return redirect()->route('teach')->with('success', 'Session request status updated successfully!');
    }
    
}
