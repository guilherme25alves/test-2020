<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CoursesResource;
use App\Courses;
use App\Helpers\VarsMessageHelper;

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

    public function get()
    {
        $courses = Courses::all();

        return response(['data' => new CoursesResource($courses), 'message' => VarsMessageHelper::$okMessage], 200);
    }

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

            return response(['message' => $message ], $httpCode);   
        }
    }

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

    public function store(Request $request)
    {
        $data = $this->validation($request,'POST');

        $descriptionCheck = isset($data['description']) ? $data['description'] : null;

        $course = Courses::create([
            'title' => $data['title'],
            'description' => $descriptionCheck
        ]);

        return response(['data' => new CoursesResource($course), 'message' => VarsMessageHelper::$createdMessage], 200);
    }

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
