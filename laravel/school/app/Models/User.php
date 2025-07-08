<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpParser\Builder\Class_;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function studentClass()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    // Relationship to AcademicYear
    public function studentAcademic()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
    static public function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first();
    }
    // In your User model (app/Models/User.php)
    // 
    // In your User model (app/Models/User.php)
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subjects', 'class_id', 'subject_id');
    }
    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'class_id');
    }
    public function class_teacher()
    {
        return $this->hasMany(AssignClassTeacher::class, 'class_id');
    }
}
