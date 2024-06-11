<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::post("/students/create", [StudentController::class, "createStudent"]);
Route::get("/students/fetch", [StudentController::class, "fetchStudent"]);
Route::get("/students/fetch/stream", [StudentController::class, "fetchStudentsByStream"]);
Route::get("/students/fetch/id", [StudentController::class, "fetchStudentById"]);


Route::get("/students/update/name", [StudentController::class, "updateStudentName"]);
Route::get("/students/update/", [StudentController::class, "updateStudent"]);

Route::get("/students/delete/id", [StudentController::class, "deleteStudentById"]);
