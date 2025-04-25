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
    $filter = $request->input('filter', 'verified');

    $query = User::query();

    // Apply filters
    switch ($filter) {
        case 'admins':
            $query->where('role', 'admin');
            break;
        case 'unverified':
            $query->whereNull('email_verified_at');
            break;
        case 'verified':
            $query->whereNotNull('email_verified_at');
            break;
        case 'all':
        default:
            // No filter
            break;
    }

    // Apply search
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('email', 'like', "%{$search}%")
              ->orWhere('name', 'like', "%{$search}%");
        });
    }

    $users = $query->paginate(10)->appends(['filter' => $filter]);

    // Keep existing cache logic for statistics
    $totalUsers = Cache::remember('total_users', 3600, fn() => User::count());
    $verifiedUsers = Cache::remember('verified_users', 3600, fn() => User::verified()->count());
    $unverifiedUsers = Cache::remember('unverified_users', 3600, fn() => User::unverified()->count());
    $adminUsers = Cache::remember('admin_users', 3600, fn() => User::admin()->count());


    return view('admin.role-management', compact('users', 'search', 'filter', 'totalUsers', 'verifiedUsers', 'unverifiedUsers', 'adminUsers'));
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
