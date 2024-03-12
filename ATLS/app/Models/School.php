<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'created_by'];

    public function users()
{
    return $this->hasMany(User::class);
}

public function studyMaterials()
{
    return $this->hasMany(StudyMaterial::class);
}

public function Clase()
{
    return $this->hasMany(Clase::class);
}
}
