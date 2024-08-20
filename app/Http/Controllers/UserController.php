<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Role;


class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 8 characters
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
                'confirmed'           // must match the password_confirmation field
            ],
        ]);
    
        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);
    
        
        
    
        // Merge the role ID into the form fields array

        $user = User::create($formFields);
        
    
        // Send verification email
        $user->sendEmailVerificationNotification();
    
        // Optionally, you can redirect the user to a page where they can check their email and click the verification link
        // return redirect()->route('verification.notice')->with('message', 'Please check your email to verify your account.');
    
        // Or, if you want to immediately log them in after verification, you can use:
        return redirect()->route('verification.notice')->with('message', 'Please check your email to verify your account.');
    }
    
    

    // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }

    // Show Login Form
    public function login() {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
    
        if (auth()->attempt($formFields)) {
            $user = auth()->user();
    
            if (!$user->hasVerifiedEmail()) {
                return redirect()->route('verification.notice')->with('message', 'Please check your email to verify your account.');
            }
    
            $request->session()->regenerate();
    
            return redirect('/')->with('message', 'You are now logged in!');
        }
    
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
    
    
    // In UserController.php

public function editProfile() {
    $user = Auth::user(); // Fetch the current user
    return view('users.profile', compact('user')); // Pass the user data to the view
}
// In UserController.php

public function updateProfile(Request $request) {
    $request->validate([
        'name' => 'required|max:255',
        'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::id())]
    ]);

    $user = Auth::user();
    $user->update($request->all());

    return redirect()->route('profile.edit')->with('message', 'Profile updated successfully!');
}
// In UserController.php

public function submitProfile(Request $request) {
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::id())]
    ]);

    $user = Auth::user();
    $user->update($validatedData);

    return redirect()->route('profile.update');
}



public function showPersonalInfo()
{
    // Retrieve stored data from session

    
    $data = session()->get('profileData', []);

    
    return view('users.profile.personal-info', compact('data'));
}






}
