<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Skill;
use App\Models\Category;
use App\Models\Availability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function create()
    {
                // Fetch all skills and availabilities
                $skills = Skill::all();
                $availabilities = Availability::all();
                // Define the time slots from 08:00 to 21:00 at one-hour intervals
    $timeSlots = [];
    $start = strtotime('08:00:00');
    $end = strtotime('21:00:00');

    for ($i = $start; $i <= $end; $i += 3600) { // 3600 seconds = 1 hour
        $timeSlots[] = date('H:i', $i); // Format without seconds
    }
        
                // Pass both variables to the view
                return view('auth.register', compact('skills', 'availabilities','timeSlots'));
    }        

    // Show the registration form with availabilities
    public function showRegistrationForm()
    {
        // Fetch all availabilities from the database
        $availabilities = Availability::all();
    
        // Define the time slots from 08:00 to 21:00 at one-hour intervals
        $timeSlots = [];
        $start = strtotime('08:00:00');
        $end = strtotime('21:00:00');
    
        for ($i = $start; $i <= $end; $i += 3600) { // 3600 seconds = 1 hour
            $timeSlots[] = date('H:i', $i); // Format without seconds
        }
    
        // Pass availabilities and timeSlots to the view
        return view('auth.register', compact('availabilities', 'timeSlots'));
    }
    

    // Handle the registration request
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
           'availabilities' => ['required', 'array'], // Ensure availabilities are selected
        'availabilities.*' => ['exists:availabilities,id'], // Validate each ID existsts
        'skills' => ['required', 'array'], // Ensure that skills are selected
        'skills.*' => ['exists:skills,id'], // Validate that each selected skill ID exists
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        // Attach the selected skills to the user (pivot table)
        $user->skills()->attach($validated['skills']);
        // Assign the default role "peer-student" to the user
        $defaultRole = Role::where('RoleName', 'peer-student')->first();
        if ($defaultRole) {
            $user->roles()->attach($defaultRole->RoleID); // Use the appropriate RoleID
        }

        // Attach each availability ID to the user
    $user->availabilities()->attach($validated['availabilities']);

        // Redirect to the intended page after registration
        return redirect()->route('dashboard');
    }
}


