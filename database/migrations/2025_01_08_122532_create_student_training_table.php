<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_training', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id'); 
            $table->unsignedBigInteger('training_schedule_id'); 
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade'); 
            $table->foreign('training_schedule_id')->references('id')->on('training_schedules')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_training');
    }
}
