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
        return view('teach', compact('skills','sessionRequests'));
    }

    public function submitSkillRequest(Request $request)
    {
        // Validate the request data
        $request->validate([
            'proof.*' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'skill_id' => 'required|array',
            'skill_id.*' => 'exists:skills,id',
        ]);

        // Create a new SkillRequest
        $skillRequest = SkillRequest::create([
            'user_id' => Auth::id(),
        ]);

        // Loop through uploaded files and save them
        foreach ($request->file('proof') as $index => $file) {
            $path = $file->store('proof_documents');

            ProofDocument::create([
                'user_id' => Auth::id(),
                'skill_id' => $request->skill_id[$index],
                'document_path' => $path,
                'skill_request_id' => $skillRequest->id,
            ]);
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
