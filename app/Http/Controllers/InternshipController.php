<?php
// app/Http/Controllers/InternshipController.php
namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // For file storage operations

class InternshipController extends Controller
{
    /**
     * Show available departments for attachments.
     */
    public function create()
{
    return view('internships.create');
}

public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'institution' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'id_file' => 'required|file|mimes:pdf|max:2048',
        'university_letter' => 'required|file|mimes:pdf|max:2048',
        'kra_pin' => 'required|file|mimes:pdf|max:2048',
        'insurance' => 'required|file|mimes:pdf|max:2048',
        'good_conduct' => 'required|file|mimes:pdf|max:2048', // Add this line
        'cv' => 'required|file|mimes:pdf|max:2048', // Add this line
    ]);

    // Handle file uploads
    $idFilePath = $request->file('id_file')->store('internship_files', 'public');
    $universityLetterPath = $request->file('university_letter')->store('internship_files', 'public');
    $kraPinPath = $request->file('kra_pin')->store('internship_files', 'public');
    $insurancePath = $request->file('insurance')->store('internship_files', 'public');
    $goodConductPath = $request->hasFile('good_conduct') ? $request->file('good_conduct')->store('internship_files', 'public') : null;
    $cvPath = $request->hasFile('cv') ? $request->file('cv')->store('internship_files', 'public') : null;

    // Create the Internship application
    InternshipApplication::create([
        'user_id' => Auth::id(),
        'full_name' => $request->full_name,
        'phone' => $request->phone,
        'institution' => $request->institution,
        'email' => $request->email,
        'id_file' => $idFilePath,
        'university_letter' => $universityLetterPath,
        'kra_pin' => $kraPinPath,
        'insurance' => $insurancePath,
        'good_conduct' => $goodConductPath,
        'cv' => $cvPath,
        'status' => 'Pending',
    ]);
    return redirect()->route('internships.index')->with('message', 'Internship application submitted successfully.');
}

public function index()
{
    // Retrieve internships applied by the authenticated user
    $internships = InternshipApplication::where('user_id', Auth::id())->paginate(10);


    return view('internships.index', compact('internships')); // Pass both internships and departments
}



public function edit($id)
    {
        $internship = InternshipApplication::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('internships.edit', compact('internship'));
    }

    public function update(Request $request, $id)
    {
        $internship = InternshipApplication::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Validate the request
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'institution' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // File fields are optional on update
            'id_file' => 'nullable|file|mimes:pdf|max:2048',
            'university_letter' => 'nullable|file|mimes:pdf|max:2048',
            'kra_pin' => 'nullable|file|mimes:pdf|max:2048',
            'insurance' => 'nullable|file|mimes:pdf|max:2048',
            'good_conduct' => 'nullable|file|mimes:pdf|max:2048',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Update the internship application
        $internship->update([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'email' => $request->email,
        ]);

        // Handle file uploads
        if ($request->hasFile('id_file')) {
            // Delete old file if exists
            if ($internship->id_file) {
                Storage::disk('public')->delete($internship->id_file);
            }
            $internship->id_file = $request->file('id_file')->store('internship_files', 'public');
        }

        if ($request->hasFile('university_letter')) {
            if ($internship->university_letter) {
                Storage::disk('public')->delete($internship->university_letter);
            }
            $internship->university_letter = $request->file('university_letter')->store('internship_files', 'public');
        }

        if ($request->hasFile('kra_pin')) {
            if ($internship->kra_pin) {
                Storage::disk('public')->delete($internship->kra_pin);
            }
            $internship->kra_pin = $request->file('kra_pin')->store('internship_files', 'public');
        }

        if ($request->hasFile('insurance')) {
            if ($internship->insurance) {
                Storage::disk('public')->delete($internship->insurance);
            }
            $internship->insurance = $request->file('insurance')->store('internship_files', 'public');
        }

        if ($request->hasFile('good_conduct')) {
            if ($internship->good_conduct) {
                Storage::disk('public')->delete($internship->good_conduct);
            }
            $internship->good_conduct = $request->file('good_conduct')->store('internship_files', 'public');
        }

        if ($request->hasFile('cv')) {
            if ($internship->cv) {
                Storage::disk('public')->delete($internship->cv);
            }
            $internship->cv = $request->file('cv')->store('internship_files', 'public');
        }

        $internship->save();

        return redirect()->route('internships.index')->with('message', 'Internship application updated successfully.');
    }




}
