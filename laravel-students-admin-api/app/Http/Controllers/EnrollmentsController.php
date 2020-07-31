<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EnrollmentsResource;
use App\Enrollments;
use App\Helpers\VarsMessageHelper;
use Carbon\Carbon;

/**
 * @group  Enrollments
 *
 * APIs for managing enrollments
 */
class EnrollmentsController extends Controller
{
    private function validation($request, $method)
    {
        switch ($method) {
            case 'POST':
                $rules = array(
                    'student_id' => 'required|numeric|exists:students,student_id', 
                    'course_id' => 'required|numeric|exists:courses,course_id', 
                    'enrollment_date' => 'nullable|before_or_equal:now'                    
                );
                break;
            case 'PUT':
                $rules = array(
                    'student_id' => 'numeric|exists:students,student_id', 
                    'course_id' => 'numeric|exists:courses,course_id', 
                    'enrollment_date' => 'nullable|before_or_equal:now'                     
                );
            default:                
                break;
        }

        return $request->validate($rules); 
    }

    /**
     * 
     *  get()
     * 
     *   Get list of all Enrollments created
	 *
     * @apiResourceCollection  App\Http\Resources\EnrollmentsResource
     * @apiResourceModel  App\Enrollments
	 *
     * @response 200 {"data": [{
     * "enrollment_id": 3,
     * "student_id": 31,
     * "course_id": 2,
     * "enrollment_date": "2020-07-25 00:05:20",
     * "created_at": "2020-07-25T00:05:20.000000Z",
     * "updated_at": "2020-07-25T00:05:20.000000Z"
     *}]}
     *
     * 
     */ 
    public function get()
    {
        $enrollments = Enrollments::all();

        return response(['data' => new EnrollmentsResource($enrollments), 'message' => VarsMessageHelper::$okMessage], 200);
    }

    /**
     *  getById($id)
     * 
     * 
     *   Get specified Enrollment by enrollment_id idenitifier
     * 
     * @apiResourceCollection  App\Http\Resources\EnrollmentsResource
     * @apiResourceModel  App\Enrollments
     *
     * @urlParam  enrollment_id required The ID of enrollment.. Example: 1
     *
     * 
     * @response 200 {"data": {
     * "enrollment_id": 3,
     * "student_id": 31,
     * "course_id": 2,
     * "enrollment_date": "2020-07-25 00:05:20",
     * "created_at": "2020-07-25T00:05:20.000000Z",
     * "updated_at": "2020-07-25T00:05:20.000000Z"
     *}}
     *
     * 
     */ 
    public function getById($id)
    {
        $message = VarsMessageHelper::$okMessage;
        $httpCode = 200;

        if(is_numeric($id)){

            $enrollment = Enrollments::find($id);        

            if(empty($enrollment)){
                $message = VarsMessageHelper::$notFoundMessage;
                $httpCode = 404;
            }

            return response(['data' => new EnrollmentsResource($enrollment), 'message' => $message], $httpCode);
        }
        else{
            $message = VarsMessageHelper::$badRequestMessage;
            $httpCode = 400;

            return response(['data'=> null,'message' => $message ], $httpCode);   
        }
    }




    /**
     *  store(Request $request)
     * 
     *  Register a new Enrollment in database
     * 
     * 
     * @bodyParam  student_id int required The student identifier. Example: 20
     * @bodyParam  course_id int required The course identifier. Example: 5
     * 
     * @response 201{
     *  "message": "Created successfully"
     * }
     * @response 302{
     *  "message" : "This course and student information already exists in an existing enrollment!"
     * }
     * @response 422{
     *  "message": "The given data was invalid",
     *  "errors" :{
     *      "student" :[
     *          "The student field is required."
     *      ]
     *  }
     * }
     *   
     */
    public function store(Request $request)
    {        
        $data = $this->validation($request,'POST');

        $enrollmentDateCheck = isset($data['enrollment_date']) ? $data['enrollment_date'] : Carbon::now('America/Sao_Paulo')->format('Y-m-d H:i:s');

        $checkEnrollment = $this->enrollmentExists($data['student_id'], $data['course_id']);

        if($checkEnrollment){
            return response(['data' => $data, 'message' => VarsMessageHelper::$existsEnrollmentMessage], 302);
        }
        
        $enrollment = Enrollments::create([
            'student_id' => $data['student_id'],
            'course_id' => $data['course_id'],
            'enrollment_date' => $enrollmentDateCheck
        ]);

        return response(['data' => new EnrollmentsResource($enrollment), 'message' => VarsMessageHelper::$createdMessage], 201);
    }

    /**
     *  update(Request $request, $id)
     * 
     *  Update an existing Enrollment
     * 
     *  Detail: In case the request is incomplete, the API assumes the old values ​​and only changes what is inserted again
     * 
     * 
     * @urlParam   enrollment_id required The ID of the enrollment. Example: 8
     * @bodyParam  student_id int required The student identifier. Example: 20
     * @bodyParam  course_id int required The course identifier. Example: 5 
     * 
     * @response 200{
     *  "message": "Retrieved successfully"
     * }
     * @response 302{
     *  "message" : "This course and student information already exists in an existing enrollment!"
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

        $enrollment = Enrollments::find($id);

        if(is_null($enrollment)){
            $message = VarsMessageHelper::$notFoundMessage;
            $httpCode = 404;
            return response(['data' => new EnrollmentsResource($enrollment), 'message' => $message], $httpCode);
        }

        $studentIdCheck = isset($data['student_id']) ? $data['student_id'] : $enrollment->student_id;
        $courseIdCheck = isset($data['course_id']) ? $data['course_id'] : $enrollment->course_id;        

        $checkEnrollment = $this->enrollmentExists($studentIdCheck, $courseIdCheck);

        if($checkEnrollment){
            return response(['data' => $data, 'message' => VarsMessageHelper::$existsEnrollmentMessage], 302);
        }

        $enrollment->student_id = $studentIdCheck;        
        $enrollment->course_id = $courseIdCheck;
        $enrollment->save();

        return response(['data' => new EnrollmentsResource($enrollment), 'message' => $message], $httpCode); 
    }

    /**
     *  delete($id)
     * 
     * 
     *  Delete an existing Enrollment
     * 
     *
     * @urlParam enrollment_id required The ID of the enrollment. Example: 8
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
       
        $enrollment = Enrollments::find($id);

        if(is_null($enrollment)){
            $message = VarsMessageHelper::$notFoundMessage;
            $httpCode = 404;
            return response(['data' => new EnrollmentsResource($enrollment), 'message' => $message], $httpCode);
        }

        $enrollment->delete();
        return response(['data' => new EnrollmentsResource($enrollment), 'message' => $message], $httpCode);
    }    

    private function enrollmentExists($studentId, $courseId)
    {        
        $checkEnrollment = Enrollments::where('student_id','=', $studentId)
            ->where('course_id', '=', $courseId)
            ->get();
                
        if(count($checkEnrollment) >0){

            return true;
        }

        return false;
    }

}
