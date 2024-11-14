<?php
namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\ProofDocument;
use App\Models\SkillRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TeachController extends Controller
{
    public function index()
    {
        $skills = Skill::withCount('users')->get();
        return view('teach', compact('skills'));
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
}
