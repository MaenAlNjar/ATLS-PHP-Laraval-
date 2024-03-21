<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['class_id', 'day'];
    public function Clase()
{
    return $this->belongsTo(Classes::class ,'class_id');
}

public function studyMaterial()
{
    return $this->belongsTo(StudyMaterial::class);
}

}
