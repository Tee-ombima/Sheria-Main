<?php

namespace App\Http\Controllers;

use App\Models\Listing;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles; // Import HasRoles trait if you're using spatie/laravel-permission
use App\Models\Role;
use App\Models\Application; // Import the Application model
use App\Models\PersonalInfo;
use App\Models\AcademicInfo;
use App\Models\ProfInfo;
use App\Models\RelevantCourses;
use Illuminate\Support\Facades\Log;

class ListingController extends Controller
{
    use HasRoles; // Use HasRoles trait if you're using spatie/laravel-permission

    // Show all listings
    public function index() {
        $query = Listing::latest()->filter(request(['tag', 'search']));
    
        // If the user is not authenticated or is not an admin, only show non-archived listings
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            $query->where('archived', false);
        }
    
        return view('listings.index', [
            'listings' => $query->paginate(6)
        ]);
    }
    
    
    

    // Show single listing
    public function show(Listing $listing) {
        // Only allow non-admins to view the listing if it is not archived
        if ($listing->archived && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Access - This listing is archived.');
        }
    
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Form
    public function create() {
        // Only allow admins to create listings
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request) {
        // Only allow admins to create listings
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'job_reference_number' => ['required', Rule::unique('listings', 'job_reference_number')],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }


        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing) {
        // Only allow admins to edit listings
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing) {
        // Only allow admins to update listings
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'job_reference_number' => ['required'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete Listing
    public function destroy(Listing $listing) {
        // Only allow admins to delete listings
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }

        if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    // Manage Listings
    public function manage() {
        // Only allow admins to manage listings
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }
        return view('listings.manage', ['listings' => auth()->listings()->get()]);
    }
    public function archive(Listing $listing) {
        // Only allow admins to archive listings
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }
    
        $listing->update(['archived' => true]);
    
        return redirect('/')->with('message', 'Listing archived successfully!');
    }
    public function unarchive(Listing $listing) {
        // Only allow admins to unarchive listings
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized Action');
        }
    
        $listing->update(['archived' => false]);
    
        return redirect('/')->with('message', 'Listing unarchived successfully!');
    }
   
    
    
    



}
