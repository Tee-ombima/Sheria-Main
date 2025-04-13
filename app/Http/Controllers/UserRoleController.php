<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = $request->user(); // Get authenticated user
            
            if (!$user || !$user->isSuperAdmin()) {
                abort(403);
            }
    
            return $next($request);
        });
    }
    /**
     * Display a paginated list of verified users with optional search functionality.
     */
    public function updatePermissions(Request $request, User $user)
{
    $permissions = $request->input('permissions', []);
    $user->update(['permissions' => $permissions]);
    return back()->with('message', 'Permissions updated successfully updated.');
}


public function index(Request $request)
{
    $search = $request->input('search');

    $query = User::whereNotNull('email_verified_at');

    if ($search) {
        $query->where('email', 'like', '%' . $search . '%');
    }

    $users = $query->paginate(10);

    // Update index method statistics
$totalUsers = Cache::remember('total_users', 3600, function () {
    return Cache::lock('total_users_lock')->block(5, function () {
        return User::count();
    });
});

$verifiedUsers = Cache::remember('verified_users', 3600, function () {
    return Cache::lock('verified_users_lock')->block(5, function () {
        return User::whereNotNull('email_verified_at')->count();
    });
});

$unverifiedUsers = Cache::remember('unverified_users', 3600, function () {
    return Cache::lock('unverified_users_lock')->block(5, function () {
        return User::whereNull('email_verified_at')->count();
    });
});

$adminUsers = Cache::remember('admin_users', 3600, function () {
    return Cache::lock('admin_users_lock')->block(5, function () {
        return User::where('role', 'admin')->count();
    });
});


    return view('admin.role-management', compact('users', 'search', 'totalUsers', 'verifiedUsers', 'unverifiedUsers', 'adminUsers'));
}
    /**
     * Toggle the role of the user between 'admin' and 'user'.
     */
    public function destroy($id)
    {
        
        $user = User::findOrFail($id);
        $wasVerified = !is_null($user->email_verified_at);
        $wasAdmin = $user->role === 'admin';
        if ($user->isSuperAdmin()) {
            abort(403, 'Superadmin users cannot be deleted');
        }
        $user->delete();
        

        // Clear relevant caches
        Cache::forget('total_users');
        $wasVerified ? Cache::forget('verified_users') : Cache::forget('unverified_users');
        if ($wasAdmin) Cache::forget('admin_users');

        return redirect()->route('admin.role-management')->with('message', 'User deleted successfully.');
    }
    
    public function toggleRole(User $user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->back()->with('error', 'Cannot modify superadmin role.');
        }
        

        $originalRole = $user->role;
        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        // Clear admin count cache if role changed
        if ($originalRole !== $user->role) {
            Cache::forget('admin_users');
        }

        return redirect()->route('admin.role-management')->with('message', 'User role updated successfully.');
    }
}
