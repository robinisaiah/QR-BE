<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingSchedule extends Model
{
    // use HasFactory;

    protected $fillable = ['title', 'start_date', 'end_date', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // public function students() {
    //     return $this->belongsToMany(Student::class, 'student_training');
    // }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_training')->withPivot('status')->withTimestamps();
    }
}
