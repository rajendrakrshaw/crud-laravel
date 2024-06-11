<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function createStudent(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required",
            "roll"=>"required",
            "stream"=>"required",
            "year"=>"required",
            "dob"=>"required",
            "city"=>"required"
        ]);

        if($validator->fails()){
            return response()->json([
                "status"=>400,
                "message"=>"Validation Error",
                "error"=>$validator->errors()
            ],400);
        }

        try{
            $student = new Student();
            $student->name = $request->name;
            $student->roll = $request->roll;
            $student->stream = $request->stream;
            $student->year = $request->year;
            $student->dob = $request->dob;
            $student->city = $request->city;
            $student->save();
            return response()->json([
                "status"=>200,
                "message"=> "Student created Successfully",
                "data" => $student
            ], 200);

        }catch(Exception $e){
            return response()->json([
                "status"=> 500,
                "message"=> "Internal Server Error",
                "error"=> $e.getMessage()
            ], 500);
        }
    }
    public function fetchStudent(){
        try{
            $students = Student::get();
            return response()->json([
                "status"=> 200,
                "message"=> "Students fetched successfully",
                "data"=> $students
            ],200);
        }catch(Exception $e){
            return response()->json([
                "status"=> 500,
                "message"=> "Internal Server Error",
                "error" => $e->getMessage()
            ],500);
        }
    }

    public function fetchStudentsByStream(Request $request){
        try{
            $student = [];
            if($request->has("stream")){
                $student = Student::where("stream", $request->stream)->get();
            }else{
                $student = Student::get();
            }
            return response()->json([
                "status"=>200,
                "message"=> "Student Fetched",
                "data"=> $student
            ],200);
        }catch(Exception $e){
            return response()->json([
                "status"=> 500,
                "message"=> "Internal Server Error",
                "error" => $e->getMessage()
            ]);
        }
    }

    public function fetchStudentById(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                "id"=>"required"
            ]);
            if($validator->fails()){
                return response()->json([
                    "status"=> 400,
                    "message"=> "Validation error",
                    "error" => $validator->errors()
                ]);
            }
            $student = Student::Where("id", $request->id)->first();
            if($student){
                return response()->json([
                    "status"=> 200,
                    "message"=> "Student found",
                    "data" => $student
                ]);
            }else{
                return response()->json([
                    "status"=> 404,
                    "message"=> "Student Not found",
                    "data" => []
                ]);
            }

        }catch(Exception $e){
            return response()->json([
                "status"=> 500,
                "message"=> "Internal Server Error",
                "error" => $e->getMessage()
            ],500);
        }
    }

    public function updateStudentName(Request $request){
        $validator = Validator::make($request->all(),[
            "id"=>"required",
            "name"=>"required"
        ]);
        if($validator->fails()){
            return response()->json([
                "status"=> 400,
                "message"=> "Validation Error",
                "error" => $validator->errors()
            ],400);
        }

        try{
            $student = Student::Where("id", $request->id)->first();
            if(!$student){
                return response()->json([
                    "status"=>404,
                    "message"=>"Student not found",
                    "data"=>[]
                ]);
            }
            $student->name = $request->name;
            $student->save();
            return response()->json([
                "status"=> 200,
                "message"=> "Student name updated",
                "data"=> $student
            ]);

        }catch(Exception $e){
            return response()->json([
                "status"=>500,
                "message"=>"Internal Server Error",
                "error"=> $e.getMessage()
            ],500);
        }
    }
    public function updateStudent(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                "id"=>"required",
            ]);
            if($validator->fails()){
                return response()->json([
                    "status"=>400,
                    "message"=>"Validation Error",
                    "error"=>$validation->errors()
                ]);
            }
            $student = Student::Where("id", $request->id)->first();
            if(!$student){
                return response()->json([
                    "status"=>404,
                    "message"=>"Student not found",
                    "data"=>[]
                ]);
            }
            if($request->has('name')){
                $student->name = $request->name;
            }
            if($request->has('roll')){
                $student->roll = $request->roll;
            }
            if($request->has('stream')){
                $student->stream = $request->stream;
            }
            if($request->has('year')){
                $student->year = $request->year;
            }
            if($request->has('dob')){
                $student->dob = $request->dob;
            }
            if($request->has('year')){
                $student->city = $request->city;
            }
            $student->save();
            return response()->json([
                "status"=> 200,
                "message"=>"Student updated successfully",
                "data"=>$student
            ]);
        }catch(Exception $e){
            return response()->json([
                "status"=> 500,
                "message"=>"Internal Server Error",
                "error"=> $e.getMessage()
            ]);
        }
    }

    public function deleteStudentById(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                "id"=> "required"
            ]);
            if($validator->fails()){
                return response()->json([
                    "status"=> 400,
                    "message"=>"Validation Error",
                    "error"=> $validator->errors()
                ],400);
            }
            $student = Student::Where("id", $request->id)->first();
            if(!$student){
                return response()->json([
                    "status"=>404,
                    "message"=>"Student not found",
                    "data"=> []
                ],404);
            }

            $student->delete();
            return response()->json([
                "status"=>200,
                "message"=>"Student deleted successfully"
            ],200);

        }catch(Exception $e){
            return response()->json([
                "status"=> 500,
                "message"=>"Internal Server Error",
                "error"=> $e.getMesaage()
            ],500);
        }
    }

}
