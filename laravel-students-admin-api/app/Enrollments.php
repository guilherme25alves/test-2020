<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollments extends Model
{
    protected $table = "enrollments";

    protected $primaryKey = "enrollment_id";

    protected $fillable = [
        'student_id', 'course_id', 'enrollment_date'   
    ];

    public function students(){
        return $this->belongsTo('App\Students');
    }

    public function courses(){
        return $this->belongsTo('App\Courses', 'course_id');
    }

}
