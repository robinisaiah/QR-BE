<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'dob',
    ];

    // public function trainings() {
    //     return $this->belongsToMany(TrainingSchedule::class, 'student_training');
    // }

    public function trainings()
    {
        return $this->belongsToMany(TrainingSchedule::class, 'student_training')->withPivot('status')->withTimestamps();
    }
}
