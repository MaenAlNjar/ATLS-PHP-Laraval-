<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Models\School;
use App\Models\StudyMaterial;
use App\Models\Classes;
use App\Models\StudentMark;
use App\Models\Schedule;

use App\Http\Controllers\createController;
use App\Http\Controllers\materialsController;

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
    return view('manager.main',compact('users','StudyMaterials'));});


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
    $classe = Classes::where('school_id', Auth::user()->school_id)->get();
    $StudyMaterials =StudyMaterial::all();
    $userz=User::where('class',0)->get(); 
return view('manager.addUser', compact('classe','users','StudyMaterials','userz'));
});

Route::post('/addMark',[materialsController::class,'addMark'])->name('addMark');

Route::get('/StudentPage/{id}/view',function($id){
View::share('title', 'ATLS');
$user= User::where('id',$id)->get();
$marks=StudentMark::where('user_id',$id)->get();
$StudyMaterials =StudyMaterial::all(); 
return view('manager.studentPage', compact('user','marks','StudyMaterials'));})->name('StudentPage');

Route::put('/users/{id}/change-class', [materialsController::class, 'changeClass'])->name('changeClass');

Route::post('/update-user-class', [materialsController::class, 'updateUserClass'])->name('updateUserClass');
