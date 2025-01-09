<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainingScheduleController;
use App\Http\Controllers\StudentTrainingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        'status' => 'success',
        'data' => $request->user(),
    ]);
});


Route::options('{any}', function () {
    return response('', 204)
        ->header('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
})->where('any', '.*');


Route::middleware(['auth:sanctum'])->group(function () {
    
Route::get('courses', [CourseController::class, 'index']);
Route::get('courses/{id}', [CourseController::class, 'show']); 
Route::post('courses', [CourseController::class, 'store']); 
Route::put('courses/{id}', [CourseController::class, 'update']); 
Route::delete('courses/{id}', [CourseController::class, 'destroy']);
Route::get('students', [StudentController::class, 'index']);
Route::get('students/{id}', [StudentController::class, 'show']); 
Route::post('students', [StudentController::class, 'store']); 
Route::put('students/{id}', [StudentController::class, 'update']); 
Route::delete('students/{id}', [StudentController::class, 'destroy']);
Route::get('training-schedules', [TrainingScheduleController::class, 'index']);
Route::get('training-schedules/{id}', [TrainingScheduleController::class, 'show']); 
Route::post('training-schedules', [TrainingScheduleController::class, 'store']); 
Route::put('training-schedules/{id}', [TrainingScheduleController::class, 'update']); 
Route::delete('training-schedules/{id}', [TrainingScheduleController::class, 'destroy']);

Route::get('student-training', [StudentTrainingController::class, 'index']);
Route::get('student-training/{id}', [StudentTrainingController::class, 'show']); 
Route::post('student-training', [StudentTrainingController::class, 'store']); 
Route::put('student-training/{id}', [StudentTrainingController::class, 'update']); 
Route::delete('student-training/{id}', [StudentTrainingController::class, 'destroy']);
Route::post('student-training/{scheduleId}/opt-in', [StudentTrainingController::class, 'optIn']);
Route::post('student-training/{scheduleId}/opt-out', [StudentTrainingController::class, 'optOut']);
});

Route::get('/unauth', function (Request $request) {
    return response()->json([
        'status' => 'error',
        'message' => 'Unauthorized. Please provide valid credentials.',
    ], 401);
})->name('unauth');

Route::post('login', [AuthController::class, 'login']);



