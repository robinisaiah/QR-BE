<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudentTraining;

class StudentTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentTrainings = StudentTraining::with('student', 'trainingSchedule')->get();
        return response()->json($studentTrainings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'training_schedule_id' => 'required|exists:training_schedules,id',
            'status' => 'required|in:in,out',
        ]);

        $studentTraining = StudentTraining::create([
            'student_id' => $request->student_id,
            'training_schedule_id' => $request->training_schedule_id,
            'status' => $request->status,
        ]);

        return response()->json($studentTraining, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'training_schedule_id' => 'required|exists:training_schedules,id',
            'status' => 'required|in:in,out',
        ]);

        $studentTraining = StudentTraining::create([
            'student_id' => $request->student_id,
            'training_schedule_id' => $request->training_schedule_id,
            'status' => $request->status,
        ]);

        return response()->json($studentTraining, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentTraining = StudentTraining::with(['student', 'trainingSchedule'])->find($id);

        if (!$studentTraining) {
            return response()->json(['message' => 'Student training record not found'], 404);
        }

        return response()->json($studentTraining);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $studentTraining = StudentTraining::find($id);

        if (!$studentTraining) {
            return response()->json(['message' => 'Student training record not found'], 404);
        }

        $request->validate([
            'student_id' => 'sometimes|exists:students,id',
            'training_schedule_id' => 'sometimes|exists:training_schedules,id',
            'status' => 'sometimes|in:in,out',
        ]);

        $studentTraining->update([
            'student_id' => $request->student_id ?? $studentTraining->student_id,
            'training_schedule_id' => $request->training_schedule_id ?? $studentTraining->training_schedule_id,
            'status' => $request->status ?? $studentTraining->status,
        ]);

        return response()->json($studentTraining);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentTraining = StudentTraining::find($id);

        if (!$studentTraining) {
            return response()->json(['message' => 'Student training record not found'], 404);
        }

        $studentTraining->delete();

        return response()->json(['message' => 'Student training record deleted successfully']);
    }

    public function optIn(Request $request, $scheduleId)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $trainingSchedule = TrainingSchedule::findOrFail($scheduleId);
        $trainingSchedule->students()->attach($request->student_id);

        return response()->json(['message' => 'Student opted in successfully']);
    }

    /**
     * Opt-out a student from a training schedule.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $scheduleId
     * @return \Illuminate\Http\Response
     */
    public function optOut(Request $request, $scheduleId)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $trainingSchedule = TrainingSchedule::findOrFail($scheduleId);
        $trainingSchedule->students()->detach($request->student_id);

        return response()->json(['message' => 'Student opted out successfully']);
    }
}
