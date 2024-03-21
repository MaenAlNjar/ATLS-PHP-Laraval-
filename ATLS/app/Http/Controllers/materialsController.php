<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyMaterial;
use App\Models\User;
use App\Models\Classes;
use App\Models\StudentMark;
use App\Models\Auth;

class materialsController extends Controller
{
    //crud for materials 
    public function addMaterials(Request $request)
    {
        $validatedData = $request->validate([
            'subject_name' => 'required|string|max:255',
            'school_id' => 'required', 
            'class_stage' => 'required'   
        ]);
        
        $nameExists = StudyMaterial::where('subject_name', $validatedData['subject_name'])
        ->where('class_stage', $validatedData['class_stage'])
        ->exists();        
        if($nameExists){
            return back()->with('error', 'Same name already exists');
        } else {
            StudyMaterial::create($validatedData);
            return back()->with('success', 'StudyMaterial Added Successfully!');
        }
    }
    public function updateSubject(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'subject_name' => 'required|string',
            'class_stage' => 'required'
            
        ]);
    
        // Find the user by name
        $user = User::where('name', $validatedData['name'])->first();
    
        if (!$user) {
            return back()->with('error', 'User not found');
        }
    
        // Update the subject for the found user
        $user->subject = $validatedData['subject_name'];
        $user->class_stage = $validatedData['class_stage']; 

        $user->save();
    
        return back()->with('success', 'Subject name updated successfully');
    }
    public function addClass(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'grade' => 'required',
            'school_id' => 'required',
        ]);
    
        $grade = $validatedData['grade'];
    
        // Define logic to categorize class_stage based on grade
        $classStage = '';
        if ($grade >= 1 && $grade <= 5) {
            $classStage = 'Primary education';
        } elseif ($grade >= 6 && $grade <= 8) {
            $classStage = 'Secondary education';
        } elseif ($grade >= 9 && $grade <= 12) {
            $classStage = 'High school';
        }
    
        // Check if the class already exists
        $existingClass = Classes::where('name', $validatedData['name'])
            ->where('grade', $validatedData['grade'])
            ->where('school_id', $validatedData['school_id'])
            ->first();
    
        if ($existingClass) {
            return back()->with('error', 'A class with the same name and grade already exists.');
        }
    
        // Add the class_stage to the validated data
        $validatedData['class_stage'] = $classStage;
    
        // Create the class
        Classes::create($validatedData);
    
        return back()->with('success', 'Class created successfully!');
    }
    public function destroyClass($id)
     {
        $class = Classes::findOrFail($id);

        $usersWithClass = User::where('class', $id)->get();
    
        foreach ($usersWithClass as $user) {
            $user->class_id = 0;
            $user->save();
        }
    
        $class->delete();
    
        return back()->with('success', 'Class Deleted successfully!');

    }
    public function addMark(Request $request)
    {

        try {
        $validatedData = $request->validate([
            'user_id' => 'required|string|max:255',
            'mark_one' => 'nullable|numeric|min:0|max:40',
            'mark_two' => 'nullable|numeric|min:0|max:40',
            'mark_final' => 'nullable|numeric|min:0|max:40',
            'study_materials_id' => 'required',
            'created_by' => 'required'
        ]);

        // Check each mark field, if null, replace with 0 or old value
        $existingMark = StudentMark::where('user_id', $validatedData['user_id'])
            ->where('study_materials_id', $validatedData['study_materials_id'])
            ->first();

        if (!$request->filled('mark_one')) {
            $validatedData['mark_one'] = $existingMark ? $existingMark->mark_one : 0;
        }

        if (!$request->filled('mark_two')) {
            $validatedData['mark_two'] = $existingMark ? $existingMark->mark_two : 0;
        }

        if (!$request->filled('mark_final')) {
            $validatedData['mark_final'] = $existingMark ? $existingMark->mark_final : 0;
        }

        if ($existingMark) {
            // Update existing mark
            $existingMark->update($validatedData);
        } else {
            // Create new mark
            StudentMark::create($validatedData);
        }

        return back()->with('success', 'Mark added successfully!');
    } catch (QueryException $e) {
        Log::error('Database Error: ' . $e->getMessage());
        return back()->with('error', 'Failed to add mark. Please try again.');
    }
    }
    public function changeClass(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->class = 0;
            $user->save();

            return back()->with('success', 'User class updated successfully to 0!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update user class. Please try again.');
        }
    }
    public function updateUserClass(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'class' => 'required|exists:classes,id',
        ]);

        try {
            $user = User::findOrFail($request->input('user_id'));
            $user->class = $request->input('class');
            $user->save();

            return back()->with('success', 'User class updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update user class. Please try again.');
        }
    }
    
}
