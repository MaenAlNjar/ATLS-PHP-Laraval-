<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User ;
class AuthController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $username = $credentials['username'];

        // Check if the username exists in the users table
        $user = User::where('username', $username)->first();

        if (!$user) {
            return back()->withErrors([
                'username' => 'The provided username does not exist.',
            ]);
        }

        // Attempt to log in the user
        if (Auth::attempt(['username' => $username, 'password' => $credentials['password']])) {
            $request->session()->regenerate();
        
            // Get the authenticated user
            $user = Auth::user();
        
            // Check the role and redirect accordingly
            if ($user->role === 'GM') {
                return redirect()->intended('/GM/mainpage');
            } elseif ($user->role === 'manager') {
                return redirect()->intended('/manager/mainpage');
            } else {
                // Handle other roles or scenarios
                return redirect()->intended('/default/landing');
            }
        }

        return back()->withErrors([
            'password' => 'The provided password is incorrect.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->forget('SESSION_LIFETIME');

        return redirect('/');
    }
    public function getUser()
    {
    $users = User::all(); 

    return view('your.blade.view', compact('users'));
    }
    public function createUser(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|unique:users',
        'password' => 'required|string',
        'role' => 'required|string',
        'school_id' => 'required|string',
        'class' => 'integer',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);
    $id = $request->input('school_id');

    try {
        User::create($validatedData);
        return back()->with('success', 'User created successfully!');
    } catch (\Illuminate\Database\QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if ($errorCode == 1062) {
            // Handle unique constraint violation (Duplicate entry)
            return back()->withInput()->withErrors(['username' => 'The username has already been taken.']);
        }
        // Other error occurred
        return back()->withInput()->withErrors(['error' => 'Error creating user.']);
    }
}

}