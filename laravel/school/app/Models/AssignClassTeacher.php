<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignClassTeacher extends Model
{
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
   public function subjects()
    {
        return $this->hasMany(ClassSubject::class, 'class_id', 'class_id')
                   ->where('teacher_id', $this->teacher_id)
                   ->with('subject');
    }

    // public function class_teacher()
    // {
    //     return $this->belongsTo(User::class, 'teacher_id');
    // }
}
