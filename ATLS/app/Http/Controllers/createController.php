<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class createController extends Controller
{
    #crud for shcool stuff
    public function createSchool(Request $request)
    {
        $user = Auth::user();
        $created_by = $user ? $user->name : 'Guest';
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'created_by' => 'required',
        ]);

        School::create($validatedData);

        return redirect()->intended('/GM/mainpage')->with('success', 'School created successfully!');
    }
    Public function store(){
        View::share('title', 'ATLS');
        $users = User::all();
        return view('GM.create', compact('users'));
    }
    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User Deleted successfully!');

    }
    public function update($id)
    {
    $school = School::findOrFail($id);
    request()->validate([
        'name' => 'required', 
        'address' => 'required',
    ]);
    $school->update([
        'name' => request('name'),
        'address' => request('address'),
    ]);
    return back()->with('success', 'School Data Updated successfully!');
    }
    public function delete($id)
    {
    $school = School::findOrFail($id);
    $school->delete();
    return back()->with('success', 'School Deleted successfully!');

    }
    
}
