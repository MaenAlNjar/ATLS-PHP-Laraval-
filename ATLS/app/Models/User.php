<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'username', 'password','role','school_id','class','class_stage'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
    
    public function managedSchools()
    {
        return $this->hasMany(School::class, 'created_by');
    }
    
    public function teacherClasses()
    {
        return $this->hasMany(Clase::class, 'teacher_id');
    }
    
    public function studyMaterials()
    {
        return $this->hasMany(StudyMaterial::class, 'created_by');
    }
}
