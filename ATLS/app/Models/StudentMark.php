<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'mark_one',
        'mark_two',
        'mark_final',
        'created_by',
        'study_materials_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function studyMaterial()
    {
        return $this->belongsTo(StudyMaterial::class, 'study_materials_id');
    }
}
