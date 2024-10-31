<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pupillage;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PupillageController extends Controller
{
    public function create()
    {
        return view('pupillages.create');
    }

    // Store the Pupillage application
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
            'good_conduct' => 'required|file|mimes:pdf|max:2048',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Handle file uploads
        $idFilePath = $request->file('id_file')->store('pupillage_files', 'public');
        $universityLetterPath = $request->file('university_letter')->store('pupillage_files', 'public');
        $kraPinPath = $request->file('kra_pin')->store('pupillage_files', 'public');
        $insurancePath = $request->file('insurance')->store('pupillage_files', 'public');
        $goodConductPath = $request->file('good_conduct')->store('pupillage_files', 'public');
        $cvPath = $request->file('cv')->store('pupillage_files', 'public');

        // Create the Pupillage application
        Pupillage::create([
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

        return redirect()->route('pupillages.index')->with('message', 'Pupillage application submitted successfully.');
    }

    // Display the user's Pupillage applications
    public function index()
    {
        $pupillages = Pupillage::where('user_id', Auth::id())->paginate(10);

        return view('pupillages.index', compact('pupillages'));
    }

    public function edit($id)
{
    $pupillage = Pupillage::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    return view('pupillages.edit', compact('pupillage'));
}

public function update(Request $request, $id)
{
    $pupillage = Pupillage::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

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

    // Update the pupillage application
    $pupillage->update([
        'full_name' => $request->full_name,
        'phone' => $request->phone,
        'institution' => $request->institution,
        'email' => $request->email,
    ]);

    // Handle file uploads
    if ($request->hasFile('id_file')) {
        if ($pupillage->id_file) {
            Storage::disk('public')->delete($pupillage->id_file);
        }
        $pupillage->id_file = $request->file('id_file')->store('pupillage_files', 'public');
    }
    // Repeat for other files...

    $pupillage->save();

    return redirect()->route('pupillages.index')->with('message', 'Pupillage application updated successfully.');
}
public function destroy($id)
{
    $pupillage = Pupillage::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    // Delete associated files
    if ($pupillage->id_file) {
        Storage::disk('public')->delete($pupillage->id_file);
    }
    // Repeat for other files...

    $pupillage->delete();

    return redirect()->route('pupillages.index')->with('message', 'Puppilage application deleted successfully.');
}


}
