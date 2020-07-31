<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CoursesResource;
use App\Http\Resources\EnrollmentsResource;
use App\Courses;
use App\Helpers\VarsMessageHelper;

/**
 * @group  Courses
 *
 * APIs for managing courses
 */
class CoursesController extends Controller
{
    private function validation($request, $method)
    {
        switch ($method) {
            case 'POST':
                $rules = array(
                    'title' => 'required|max:200',
                    'description' => 'nullable|max:255'                    
                );
                break;
            case 'PUT':
                $rules = array(
                    'title' => 'max:100',
                    'description' => 'nullable|max:200'                    
                );
            default:                
                break;
        }

        return $request->validate($rules);        
    }

    /**
     *  get()
     * 
     * 
     *   Get list of all Courses created
	 *
	 *
     * @apiResourceCollection  App\Http\Resources\CoursesResource
     * @apiResourceModel  App\Courses
     * 
     * @response 200 {"data": [{
     *  "course_id": 4,
     *  "title": "Biology",
     *  "description": "Lessons on the behavior of marine animals",
     *  "created_at": "2020-07-25T00:05:20.000000Z",
     *  "updated_at": "2020-07-25T00:05:20.000000Z"
     * }]}
     *
     * 
     */
    public function get()
    {
        $courses = Courses::all();

        return response(['data' => new CoursesResource($courses), 'message' => VarsMessageHelper::$okMessage], 200);
    }

    /**
     *  
     *  getById($id)
     * 
     * 
    *   Get specified Course by course_id idenitifier
    * 
    * @apiResourceCollection  App\Http\Resources\CoursesResource
    * @apiResourceModel  App\Courses
    *
    * @urlParam  course_id required The ID of course.. Example: 1
    * 
    *  @response 200 {"data": {
     *  "course_id": 4,
     *  "title": "Biology",
     *  "description": "Lessons on the behavior of marine animals",
     *  "created_at": "2020-07-25T00:05:20.000000Z",
     *  "updated_at": "2020-07-25T00:05:20.000000Z"
    * }}
    * @response  404 {
    *  "message": "Resource not found"
    * }
    * @response  400 {
    *  "message": "Null parameter detected [course_id]"
    * }
    *
     */
    public function getById($id)
    {
        $message = VarsMessageHelper::$okMessage;
        $httpCode = 200;

        if(is_numeric($id)){

            $course = Courses::find($id);        

            if(empty($course)){
                $message = VarsMessageHelper::$notFoundMessage;
                $httpCode = 404;
            }

            return response(['data' => new CoursesResource($course), 'message' => $message], $httpCode);
        }
        else{
            $message = VarsMessageHelper::$badRequestMessage;
            $httpCode = 400;

            return response([ 'data'=> null, 'message' => $message ], $httpCode);   
        }
    }

    /**
     * 
     *   getByTitle($title)
     * 
     * 
    * 
    *  Get specified Course by title field 
    *
    *
    * @apiResourceCollection  App\Http\Resources\CoursesResource
    * @apiResourceModel  App\Courses
    * 
    * @urlParam  title required The Title of course.. Example: "Biology"
    * 
    * @response 200  {"data": [{
     *  "course_id": 4,
     *  "title": "Biology",
     *  "description": "Lessons on the behavior of marine animals",
     *  "created_at": "2020-07-25T00:05:20.000000Z",
     *  "updated_at": "2020-07-25T00:05:20.000000Z"
    * }]}
    * @response  404 {
    *  "message": "Resource not found"
    * }
    * @response  400 {
    *  "message": "Null parameter detected [title]"
    * }
    *
     */    
    public function getByTitle($title)
    {
        $message = VarsMessageHelper::$okMessage;
        $httpCode = 200;

        if(is_null($title)){
            $message = VarsMessageHelper::$nullParameterMessage;
            $httpCode = 400;
            return response(['message' => $message], $httpCode);
        }

        $course = Courses::where('title', 'like','%'.$title.'%')->get();

        if(count($course) > 0){
            $message = VarsMessageHelper::$okMessage;
            $httpCode = 200;            
        }else{
            $message = VarsMessageHelper::$notFoundMessage;
            $httpCode = 404;
        }

        return response(['data' => new CoursesResource($course), 'message' => $message], $httpCode);
    }

    
    /**
     *  getEnrollmentsByCourse($courseId)
     * 
     *  Get list of Enrollments for specified Course, identifier by ID course 
     * 
     * @apiResourceCollection  App\Http\Resources\CoursesResource
     * @apiResourceModel  App\Courses
     * 
     * @urlParam  course_id required The ID of course. Example: 9
     * 
     * 
    * @response 200 {"data":{
    *  "enrollment_id": 3,
    *  "student_id": 31,
    *  "course_id": 2,
    *  "enrollment_date": "2020-07-25 00:05:20",
    *  "created_at": "2020-07-25T00:05:20.000000Z",
    *  "updated_at": "2020-07-25T00:05:20.000000Z"
    * }}
     * @response  404 {
     *  "message":"Resource not found"
     * }
     * @response  400 {
     *  "message": "Null parameter detected [course_id]"
     * }
     * 
     */    
    public function getEnrollmentsByCourse($courseId)
    {
        $message = VarsMessageHelper::$badRequestMessage;
        $httpCode = 400;

        if(is_numeric($courseId)){
            $courses = Courses::find($courseId);
            
            if(!is_null($courses)){
                $enrollmentsList = $courses->enrollments()->get();
                
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
     * 
     *  store(Request $request)
     * 
     * 
     *  Register a new Course in database
     * 
     *
     * @bodyParam  title string required The title of the course. Example: "Algorithm Classes"
     * @bodyParam  description string The description of the course. Example: "Lessons to learn about POO"    
     * 
     * @response 201{
     *  "message": "Created successfully"
     * }
     * @response 422{
     *  "message": "The given data was invalid",
     *  "errors" :{
     *      "title" :[
     *          "The title field is required."
     *      ]
     *  }
     * }
     * 
     *  
     */
    public function store(Request $request)
    {
        $data = $this->validation($request,'POST');

        $descriptionCheck = isset($data['description']) ? $data['description'] : null;

        $course = Courses::create([
            'title' => $data['title'],
            'description' => $descriptionCheck
        ]);

        return response(['data' => new CoursesResource($course), 'message' => VarsMessageHelper::$createdMessage], 201);
    }

    /**
     *  update(Request $request, $id)
     * 
     * 
     *  Update an existing Course
     * 
     *  Detail: In case the request is incomplete, the API assumes the old values ​​and only changes what is inserted again
     * 
     * 
     * @urlParam   course_id required The ID of the course. Example: 8
     * @bodyParam  title string required The title of the course. Example: "Algorithm Classes"
     * @bodyParam  description string The description of the course. Example: "Lessons to learn about POO"   
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

        $course = Courses::find($id);

        if(is_null($course)){
            $message = VarsMessageHelper::$notFoundMessage;
            $httpCode = 404;
            return response(['data' => new CoursesResource($course), 'message' => $message], $httpCode);
        }

        $titleCheck = isset($data['title']) ? $data['title'] : $course->title;
        $descriptionCheck = isset($data['description']) ? $data['description'] : $course->description;        

        $course->title = $titleCheck;        
        $course->description = $descriptionCheck;
        $course->save();

        return response(['data' => new CoursesResource($course), 'message' => $message], $httpCode); 
    }

    /**
     * 
     *  delete($id)
     * 
     * 
     *  Delete an existing Course
     * 
     *
     * @urlParam course_id required The ID of the course. Example: 8
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
       
        $course = Courses::find($id);

        if(is_null($course)){
            $message = VarsMessageHelper::$notFoundMessage;
            $httpCode = 404;
            return response(['data' => new CoursesResource($course), 'message' => $message], $httpCode);
        }

        $course->delete();
        return response(['data' => new CoursesResource($course), 'message' => $message], $httpCode);
    }    
}
