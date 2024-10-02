<?php
// app/Http/Controllers/InternshipController.php
namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipController extends Controller
{
    /**
     * Show available departments for attachments.
     */
    public function create()
{
    $departments = Department::where('archived', false)->get();
    return view('internships.create', compact('departments'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'institution' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'id_file' => 'required|file|mimes:pdf|max:5120',
        'university_letter' => 'required|file|mimes:pdf|max:5120',
        'kra_pin' => 'required|file|mimes:pdf|max:5120',
        'insurance' => 'required|file|mimes:pdf|max:5120',
    ]);

    // Save files
    $idFile = $request->file('id_file')->store('documents');
    $universityLetter = $request->file('university_letter')->store('documents');
    $kraPin = $request->file('kra_pin')->store('documents');
    $insurance = $request->file('insurance')->store('documents');

    // Create application
    InternshipApplication::create([
        'user_id' => auth()->id(),
        'department_id' => $request->department_id,
        'full_name' => $request->full_name,
        'phone' => $request->phone,
        'institution' => $request->institution,
        'email' => $request->email,
        'id_file' => $idFile,
        'university_letter' => $universityLetter,
        'kra_pin' => $kraPin,
        'insurance' => $insurance,
    ]);
    session()->flash('message', 'Successfully applied for attachement.');


    return redirect()->route('internships.index');
}
public function index()
{
    // Retrieve internships applied by the authenticated user
    $internships = InternshipApplication::where('user_id', auth()->id())->get();

    // If you want to display departments in the user view, retrieve them as well
    $departments = Department::where('archived', false)->get();

    return view('internships.index', compact('internships', 'departments')); // Pass both internships and departments
}

public function apply(Department $department)
{
    // Return the view with the department information
    return view('internships.apply', compact('department'));
}



}
