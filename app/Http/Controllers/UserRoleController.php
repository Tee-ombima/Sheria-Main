<?php

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

        // Modify the query to include search functionality for verified users
        $query = User::whereNotNull('email_verified_at');

        // If there's a search query, filter users by email
        if ($search) {
            $query->where('email', 'like', '%' . $search . '%');
        }

        // Paginate the result
        $users = $query->paginate(10);

        // Get user statistics
        $totalUsers = User::count(); // Total users
        $verifiedUsers = User::whereNotNull('email_verified_at')->count(); // Verified users
        $unverifiedUsers = User::whereNull('email_verified_at')->count(); // Unverified users
        $adminUsers = User::where('role', 'admin')->count(); // Users with 'admin' role

        // Pass the statistics and users to the view
        return view('admin.role-management', compact('users', 'search', 'totalUsers', 'verifiedUsers', 'unverifiedUsers', 'adminUsers'));
    }

    /**
     * Toggle the role of the user between 'admin' and 'user'.
     */
    public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete(); // Or use soft deletes if applicable

    return redirect()->route('admin.role-management')->with('success', 'User deleted successfully.');
}

    public function toggleRole(User $user)
    {
        // Toggle between 'admin' and 'user'
        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return redirect()->route('admin.role-management')->with('success', 'User role updated successfully.');
    }
}
