<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    public function FeeHead(){
        return $this->belongsTo(FeeHead::class,'fee_head_id');
    }
    public function AcademicYear(){
        return $this->belongsTo(AcademicYear::class,'academic_id');
    }
    public function Class(){
        return $this->belongsTo(Classes::class,'class_id');
    }
}
