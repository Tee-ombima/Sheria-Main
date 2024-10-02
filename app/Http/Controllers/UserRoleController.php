<?php

// app/Http/Controllers/UserRoleController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a paginated list of verified users with optional search functionality.
     */
    public function index(Request $request)
    {
        // Fetch the search query
        $search = $request->input('search');

        // Modify the query to include search functionality
        $query = User::whereNotNull('email_verified_at');

        // If there's a search query, filter users by email
        if ($search) {
            $query->where('email', 'like', '%' . $search . '%');
        }

        // Paginate the result
        $users = $query->paginate(10);

        return view('admin.role-management', compact('users', 'search'));
    }

    /**
     * Toggle the role of the user between 'admin' and 'user'.
     */
    public function toggleRole(User $user)
    {
        // Toggle between 'admin' and 'user'
        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return redirect()->route('admin.role-management')->with('success', 'User role updated successfully.');
    }
}
