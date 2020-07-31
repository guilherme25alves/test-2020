<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\StudentsResource;
use App\Http\Resources\EnrollmentsResource;
use App\Students;
use App\Helpers\VarsMessageHelper;

/**
 * @group  Students
 *
 * APIs for managing students
 */
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
    

    /**
     *  get()
     * 
    *   Get list of all Students created
	*
	*
    * @response 200 {"data": [{
    *  "student_id": 1,
    *  "name": "Dr. Kendra Carroll",
    *  "email": "kris45@.org",
    *  "birthdate": "1991-03-10",
    *  "created_at": "2020-07-25T00:05:20.000000Z",
    * "updated_at": "2020-07-25T00:05:20.000000Z"
    * },
    * {
     * "student_id": 2,
     * "name": "Mitchel Cartwright",
     * "email": "abigale61@.net",
     * "birthdate": "1978-04-22",
     * "created_at": "2020-07-25T00:05:20.000000Z",
     * "updated_at": "2020-07-25T00:05:20.000000Z"
     * }]}
     *
     * 
     */    
    public function get()
    {        
        $students = Students::all();

        return response(['data' => new StudentsResource($students), 'message' => VarsMessageHelper::$okMessage], 200);
    }

    /**
     *   getById($id)
     * 
     * 
    *   Get specified Student by student_id idenitifier
    * 
    * @urlParam student_id required The ID of student. Example: 1
    * 
    *   @response 200 {"data":  {
    * "student_id": 2,
    * "name": "Mitchel Cartwright",
    * "email": "abigale61@example.net",
    * "birthdate": "1978-04-22",
    * "created_at": "2020-07-25T00:05:20.000000Z",
    * "updated_at": "2020-07-25T00:05:20.000000Z"
    * }}
    * @response  404 {
    *  "message": "Resource not found"
    * }
    * @response  400 {
    *  "message": "Null parameter detected"
    * }
    *
    */
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

    /**
     * 
     *  getByTextField($textValue)
     * 
    *   Get list of Students by text sent to search for email or name
    * 
    * @urlParam  textfield required The part of field searched (name or e-mail).. Example: "Ale"
    * 
    *   @response 200 {"data":  {
    * "student_id": 2,
    * "name": "Mitchel Cartwright",
    * "email": "abigale61@example.net",
    * "birthdate": "1978-04-22",
    * "created_at": "2020-07-25T00:05:20.000000Z",
    * "updated_at": "2020-07-25T00:05:20.000000Z"
    * }}
     * @response 404{
     *  "message": "Resource not found"
     * }
    * @response  400 {
    *  "message": "Null parameter detected [textValue]"
    * }
    *
    */
    public function getByTextField($textValue)
    {
        $message = VarsMessageHelper::$okMessage;
        $httpCode = 200;

        if(is_null($textValue)){
            $message = VarsMessageHelper::$nullParameterMessage;
            $httpCode = 400;
            return response(['data'=> null, 'message' => $message], $httpCode);
        }

        $student = Students::where('name', 'like','%'.$textValue.'%')
            ->orWhere('email', 'like','%'.$textValue.'%')
            ->get();

        if(count($student) > 0){
            $message = VarsMessageHelper::$okMessage;
            $httpCode = 200;            
        }else{
            $message = VarsMessageHelper::$notFoundMessage;
            $httpCode = 404;
        }

        return response(['data' => new StudentsResource($student), 'message' => $message], $httpCode);
    }


    /**
     * 
     *  getByName($name)
     * 
    * 
    *  Get Students by part of name searched
    * 
    * 
    * @urlParam  name required The Name or part of name of Students.. Example: "Dr. or Kendra Carroll"
    * 
    * @response 200 {"data": [    {
    *  "student_id": 1,
    *  "name": "Dr. Kendra Carroll",
    *  "email": "kris45@example.org",
    *  "birthdate": "1991-03-10",
    *  "created_at": "2020-07-25T00:05:20.000000Z",
    * "updated_at": "2020-07-25T00:05:20.000000Z"
    * }]}
    * @response  404 {
    *  "message": "Resource not found "
    * }
    * @response  400 {
    *  "message": "Null parameter detected [name]"
    * }
    *
     */  
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


    /**
     * 
     *  getByEmail($email)
     * 
     * 
    *
    *  Get specified Student by email field 
    * 
    * 
    * @urlParam  email required The complete Email of Student.. Example: "kris45@example.org"
    * 
     * @response 200 { "data":{
    *  "student_id": 1,
    *  "name": "Dr. Kendra Carroll",
    *  "email": "kris45@example.org",
    *  "birthdate": "1991-03-10",
    *  "created_at": "2020-07-25T00:05:20.000000Z",
    * "updated_at": "2020-07-25T00:05:20.000000Z"
    * }}
    *
    * @response  404 {
    *  "message": "Resource not found"
    * }
    * @response  400 {
    *  "message": "Null parameter detected [email]"
    * }
    *
     */  
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

    /**
     * 
     *  getEnrollmentsByStudent($studentId)
     * 
     * 
     *  Get list of Enrollments for specified Student, identifier by ID student 
     * 
     * 
     * @urlParam  student_id required The ID of Student. Example: 9
     * 
     * 
    * @response 200 {"data": [{
    *  "enrollment_id": 3,
    *  "student_id": 31,
    *  "student_id": 2,
    *  "enrollment_date": "2020-07-25 00:05:20",
    *  "created_at": "2020-07-25T00:05:20.000000Z",
    *  "updated_at": "2020-07-25T00:05:20.000000Z"
    * }] }
     * @response 404{
     *  "message": "Resource not found"
     * }
     * @response  400{
     *  "message": "Null parameter detected [student_id]"
     * }
     * 
     */  
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

    /**
     *  store(Request $request)
     * 
     * 
     *  Register a new Student in database
     * 
     * 
     * @bodyParam  name string required The name of the student. Example: "Abigail"
     * @bodyParam  email string required The email of the student. Example: abigale61@example.net"
     * @bodyParam  birthdate date Student's date of birth. Example: 1978-04-22"  
     * 
     * @response 201{
     *  "message": "Created successfully"
     * }
     * @response 422{
     *  "message" : "The given data was invalid",
     *  "errors": {
     *      "name":[
     *          "The name field is required."
     *      ]
     *   }
     * }
     *   
     */
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

    /**
     * 
     *  update(Request $request, $id)
     * 
     *
     *  Update an existing Student
     *  Detail: In case the request is incomplete, the API assumes the old values ​​and only changes what is inserted again
     * 
     * 
     * @urlParam   student_id required The ID of the student. Example: 8
     * @bodyParam  name string  The name of the student. Example: "Abigail"
     * @bodyParam  email string The email of the student. Example: abigale61@example.net"
     * @bodyParam  birthdate date Student's date of birth. Example: 1978-04-22"  
     * 
     * @response 200{
     *  "message": "Retrieved successfully"
     * }
     * @response 404{
     *  "message": "Resource not found"
     * }
     *   
     */
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

    /**
     * 
     *  delete($id)
     * 
     * 
     *  Delete an existing Student
     * 
     *
     * @urlParam  student_id required The ID of the student. Example: 8
     * 
     * 
     * @response 200{
     *  "message": "Deleted successfully"
     * }
     * @response 404{
     *  "message": "Resource not found"
     * }
     */
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
