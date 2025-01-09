<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

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
