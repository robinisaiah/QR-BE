<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrainingSchedule;
use App\Course;

class TrainingScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = TrainingSchedule::with('course')->get(); // Include course details
        return response()->json($schedules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'course_id' => 'required|exists:courses,id',
        ]);

        $schedule = TrainingSchedule::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'course_id' => $request->course_id,
        ]);

        return response()->json($schedule, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = TrainingSchedule::with('course')->find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Training schedule not found'], 404);
        }

        return response()->json($schedule);
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
        $schedule = TrainingSchedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Training schedule not found'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'course_id' => 'required|exists:courses,id',
        ]);

        $schedule->update([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'course_id' => $request->course_id,
        ]);

        return response()->json($schedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = TrainingSchedule::find($id);

        if (!$schedule) {
            return response()->json(['message' => 'Training schedule not found'], 404);
        }

        $schedule->delete();

        return response()->json(['message' => 'Training schedule deleted successfully']);
    }
    
}
