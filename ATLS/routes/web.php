<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Collection;

use App\Models\User;
use App\Models\School;
use App\Models\StudyMaterial;
use App\Models\Classes;
use App\Models\StudentMark;
use App\Models\Schedule;

use App\Http\Controllers\createController;
use App\Http\Controllers\materialsController;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    View::share('title', 'ATLS');
    return view('layouts.app');
});
Route::get('/', function () {
    if (Auth::check()) {
        Auth::logout();
    }

    $users = User::all();
    $schools = School::all();

    View::share('title', 'ATLS');
    return view('login.login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/GM/mainpage', function (){
    View::share('title', 'ATLS');
    $schools=School::all();
    return view('GM.main',compact('schools'));});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/create',[createController::class, 'store'])->name('store');

Route::post('/create/school', [createController::class, 'createSchool'])->name('createSchool');

Route::get('/GM/{id}/view',function ($id)
{
    $school = School::findOrFail($id);
    $users = User::where('school_id',$id)->get();
        View::share('title', 'ATLS');
    return view('GM.view', compact('school','users'));});

Route::post('/create/user',[AuthController::class, 'createUser'])->name('createUser');

Route::delete('/delete/{id}/user',[createController::class, 'destroy'])->name('destroy');

Route::get('/edite/{id}/school',function($id){
$school = School::findOrFail($id);
View::share('title', 'ATLS');
return view('GM.edite', compact('school'));});

Route::put('/school/{id}/update', [createController::class, 'update'])->name('update');

Route::delete('/school/{id}/delete', [createController::class, 'delete'])->name('delete');

Route::get('/manager/mainpage', function (){
    View::share('title', 'ATLS');
    if(Auth::check()){
        $users = User::where('school_id', Auth::user()->school_id)
        ->where('role', 'teacher')
        ->get();}
        $StudyMaterials =StudyMaterial::all(); 
        $class=Schedule::all();
    return view('manager.main',compact('users'));});


Route::post('/addMaterials', [materialsController::class, 'addMaterials'])->name('addMaterials');

Route::put('/updatesubject', [materialsController::class, 'updateSubject'])->name('updateSubject');

Route::delete('/user/{id}/delete', [createController::class, 'destroy'])->name('destroy');


Route::get('/createClass',function ()  {
    View::share('title', 'ATLS');
    $classe = Classes::where('school_id',Auth::user()->school_id)->get()->sortBy('grade');
    
    return view('manager.creat',compact('classe'));
})->name('createClass');

Route::post('/addClass', [materialsController::class, 'addClass'])->name('addClass');

Route::delete('/Class/{id}/delete', [materialsController::class, 'destroyClass'])->name('destroyClass');

Route::get('/Schedule/{id}/view', function ($id) {
    View::share('title', 'ATLS');
    $schedules = Schedule::where('class_id', $id)->get();
    return view('manager.Schedule', compact('schedules'));
})->name('ClassSchedule');

Route::get('/view/{id}/class', function ($id) {
    View::share('title', 'ATLS');
    $classe = Classes::findOrFail($id);
    $users= User::where('class',$id)->get();
    $StudyMaterials =StudyMaterial::all(); 
    $StudentMarks=StudentMark::all();
return view('manager.view', compact('classe','users','StudyMaterials','StudentMarks'));
});

Route::get('/addUser', function () {
    View::share('title', 'ATLS');
    $users = User::where('school_id',Auth::user()->school_id)->get();
    $userm = User::where('school_id',Auth::user()->school_id)
    ->whereIn('role', ['teacher', 'manager'])
    ->get();

    $classe = Classes::where('school_id', Auth::user()->school_id)->get();
    $StudyMaterials =StudyMaterial::all();
    $userz=User::where('class',0)->get(); 
return view('manager.addUser', compact('classe','users','StudyMaterials','userz','userm'));
});

Route::post('/addMark',[materialsController::class,'addMark'])->name('addMark');

Route::get('/StudentPage/{id}/view',function($id){
View::share('title', 'ATLS');
$user= User::where('id',$id)->first();
$marks=StudentMark::where('user_id',$id)->get();
$StudyMaterials =StudyMaterial::all(); 

return view('manager.studentPage', compact('user','marks','StudyMaterials'));})->name('StudentPage');

Route::put('/users/{id}/change-class', [materialsController::class, 'changeClass'])->name('changeClass');

Route::post('/update-user-class', [materialsController::class, 'updateUserClass'])->name('updateUserClass');

Route::get('/viewteacher/{id}', function ($id) {
    View::share('title', 'ATLS');
    $user = User::findOrFail($id);
    $classe = Classes::where('school_id', Auth::user()->school_id)->get()->sortBy('grade');
    $schedules = Schedule::all();
    return view('manager.viewTeacher', compact('user', 'classe','schedules'));
})->name('viewTeacher');


Route::post('/generate-schedules/{classStage}', [ScheduleController::class, 'generateSchedules'])->name('generateSchedules');

Route::get('/Teachers', function (){
    View::share('title', 'ATLS');
    if(Auth::check()){
        $users = User::where('school_id', Auth::user()->school_id)
        ->where('role', 'teacher')
        ->get();}
        $StudyMaterials =StudyMaterial::all(); 
        return view('manager.Teachers',compact('users','StudyMaterials'));
});

Route::get('/teacher/mainpage', function (){
    View::share('title', 'ATLS');
    if(Auth::check()){
        $users = User::where('school_id', Auth::user()->school_id)
        ->where('role', 'teacher')
        ->get();}
        
return view('Teacher.main',compact('users'));});

Route::get('/teacher/class', function (){
        View::share('title', 'ATLS');
        $classe = Classes::where('school_id', Auth::user()->school_id)->get()->sortBy('grade');
        $user=User::where('id', Auth::user()->id)->first();   
        $schedules = Schedule::all();
        $StudyMaterials =StudyMaterial::all(); 

return view('Teacher.class',compact('user','classe','schedules','StudyMaterials'));});

Route::get('/teacher/schedule', function (){
    View::share('title', 'ATLS');
    $classe = Classes::where('school_id', Auth::user()->school_id)->get()->sortBy('grade');
    $user=User::where('id', Auth::user()->id)->first();   
    $schedules = Schedule::all();
    $StudyMaterials =StudyMaterial::all(); 
                
return view('Teacher.schedule',compact('user','classe','schedules','StudyMaterials'));});

Route::get('/student/mainpage', function (){
    View::share('title', 'ATLS');
    if(Auth::check()){
        $users = User::where('school_id', Auth::user()->school_id)
        ->where('role', 'teacher')
        ->get();}
        
return view('Student.main',compact('users'));});

Route::get('/student/class', function (){
    View::share('title', 'ATLS');

    // Assuming a user belongs to one class
    $user = Auth::user();
    $classe = Classes::where('id', $user->class)->first();

    $users = User::where('class', $classe->id)->get();


    return view('Student.class', compact('classe','users'));
});


Route::get('/student/schedule', function (){
    View::share('title', 'ATLS');
    $classe = Classes::where('school_id', Auth::user()->school_id)->get()->sortBy('grade');
    $user=User::where('id', Auth::user()->id)->first();   
    $schedules = Schedule::all();
    $StudyMaterials =StudyMaterial::all(); 
                
return view('Student.schedule',compact('user','classe','schedules','StudyMaterials'));});

Route::get('/classView/{id}/StudenMark', function ($id) {
    View::share('title', 'ATLS');
    $classe = Classes::where('id',$id)->get();
    $StudyMaterials =StudyMaterial::all(); 
    $StudentMarks=StudentMark::where('user_id',$id)->get();
return view('Student.classView', compact('classe','StudyMaterials','StudentMarks'));
})->name('StudentMark');