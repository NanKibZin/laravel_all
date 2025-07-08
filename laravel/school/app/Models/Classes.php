<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
       
    ];
    public function classSubjects()
{
    return $this->hasMany(ClassSubject::class, 'class_id')->where('status', '1');
}

public function students()
{
    return $this->hasMany(User::class, 'class_id')->where('role', 'student');
}
}
