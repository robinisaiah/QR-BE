<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all(); 
        return response()->json($courses);
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json($course, 201);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id); 

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404); // Return 404 if not found
        }

        return response()->json($course);
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
        $course = Course::find($id); 

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404); 
        }

  
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

     
        $course->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json($course); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id); 

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404); 
        }

        $course->delete(); 

        return response()->json(['message' => 'Course deleted successfully']);
    }
}
