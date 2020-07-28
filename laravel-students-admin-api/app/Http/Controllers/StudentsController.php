<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\StudentsResource;
use App\Http\Resources\EnrollmentsResource;
use App\Students;
use App\Helpers\VarsMessageHelper;

class StudentsController extends Controller
{
    private function validation($request, $method)
    {
        switch ($method) {
            case 'POST':
                $rules = array(
                    'name' => 'required|max:100',
                    'email' => 'required|email|max:200|unique:students',
                    'birthdate' => 'nullable|date_format:Y-m-d|before:10 years ago'
                );
                break;
            case 'PUT':
                $rules = array(
                    'name' => 'max:100',
                    'email' => 'email|max:200',
                    'birthdate' => 'nullable|date_format:Y-m-d|before:10 years ago'
                );
            default:                
                break;
        }

        return $request->validate($rules);
    }
    
    public function get()
    {        
        $students = Students::all();

        return response(['data' => new StudentsResource($students), 'message' => VarsMessageHelper::$okMessage], 200);
    }

    public function getById($id)
    {
        $message = VarsMessageHelper::$okMessage;
        $httpCode = 200;

        if(is_numeric($id)){

            $student = Students::find($id);        

            if(empty($student)){
                $message = VarsMessageHelper::$notFoundMessage;
                $httpCode = 404;
            }

            return response(['data' => new StudentsResource($student), 'message' => $message], $httpCode);
        }
        else{
            $message = VarsMessageHelper::$badRequestMessage;
            $httpCode = 400;

            return response(['message' => $message], $httpCode);   
        }        
    }

    public function getByName($name)
    {
        $message = VarsMessageHelper::$okMessage;
        $httpCode = 200;

        if(is_null($name)){
            $message = VarsMessageHelper::$nullParameterMessage;
            $httpCode = 400;
            return response(['data'=> null, 'message' => $message], $httpCode);
        }

        $student = Students::where('name', 'like','%'.$name.'%')->get();

        if(count($student) > 0){
            $message = VarsMessageHelper::$okMessage;
            $httpCode = 200;            
        }else{
            $message = VarsMessageHelper::$notFoundMessage;
            $httpCode = 404;
        }

        return response(['data' => new StudentsResource($student), 'message' => $message], $httpCode);
    }

    public function getByEmail($email)
    {
        $message = VarsMessageHelper::$okMessage;
        $httpCode = 200;

        if(is_null($email)){
            $message = VarsMessageHelper::$nullParameterMessage;
            $httpCode = 400;
            return response(['data'=> null,'message' => $message], $httpCode);
        }

        $student = Students::where('email', $email)->first();

        if(!is_null($student)){
            $message = VarsMessageHelper::$okMessage;
            $httpCode = 200;            
        }else{
            $message = VarsMessageHelper::$notFoundMessage;
            $httpCode = 404;
        }

        return response(['data' => new StudentsResource($student), 'message' => $message], $httpCode);
    }

    public function getEnrollmentsByStudent($studentId){
          
        $message = VarsMessageHelper::$badRequestMessage;
        $httpCode = 400;

        if(is_numeric($studentId)){
            $students = Students::find($studentId);
            
            if(!is_null($students)){
                $enrollmentsList = $students->enrollments()->get();
                
                if(count($enrollmentsList) > 0){
                    $message = VarsMessageHelper::$okMessage;
                    $httpCode = 200;      
                    return response(['data' => new EnrollmentsResource($enrollmentsList), 'message' => $message], $httpCode);          
                }
            }                        
                        
            $message = VarsMessageHelper::$notFoundMessage;
            $httpCode = 404;            
        }   
        
        return response(['data'=> null,'message' => $message], $httpCode);
    }

    public function store(Request $request)
    {
        $data = $this->validation($request,'POST');        

        $birthdateCheck = isset($data['birthdate']) ? $data['birthdate'] : null;

        $student = Students::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'birthdate' => $birthdateCheck
        ]);

        return response(['data' => new StudentsResource($student), 'message' => VarsMessageHelper::$createdMessage], 201);
    }

    public function update(Request $request, $id)
    {
        $message = VarsMessageHelper::$okMessage;
        $httpCode = 200;

        $data = $this->validation($request, 'PUT'); 

        $student = Students::find($id);

        if(is_null($student)){
            $message = VarsMessageHelper::$notFoundMessage;
            $httpCode = 404;
            return response(['data' => new StudentsResource($student), 'message' => $message], $httpCode);
        }

        $birthdateCheck = isset($data['birthdate']) ? $data['birthdate'] : $student->birthdate;
        $nameCheck = isset($data['name']) ? $data['name'] : $student->name;
        $emailCheck = isset($data['email']) ? $data['email'] : $student->email;

        $student->name = $nameCheck;
        $student->email = $emailCheck;
        $student->birthdate = $birthdateCheck;
        $student->save();

        return response(['data' => new StudentsResource($student), 'message' => $message], $httpCode);        
    }

    public function delete($id)
    {
        $message = VarsMessageHelper::$deletedMessage;
        $httpCode = 200;
       
        $student = Students::find($id);

        if(is_null($student)){
            $message = VarsMessageHelper::$notFoundMessage;
            $httpCode = 404;
            return response(['data' => new StudentsResource($student), 'message' => $message], $httpCode);
        }

        $student->delete();
        return response(['data' => new StudentsResource($student), 'message' => $message], $httpCode);
    }    

}
