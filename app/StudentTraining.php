<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTraining extends Model
{

    protected $table = "student_training";
    protected $fillable = [
        'student_id',
        'training_schedule_id',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function trainingSchedule()
    {
        return $this->belongsTo(TrainingSchedule::class);
    }
}
