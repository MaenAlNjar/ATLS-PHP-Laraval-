<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
        'school_id',
        // Add any other fields that you want to allow for mass assignment
    ];
    public function school()
{
    return $this->belongsTo(School::class);
}

public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

public function schedules()
{
    return $this->belongsToMany(Schedule::class);
}

}
