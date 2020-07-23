<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = "courses";

    protected $primaryKey = "course_id";

    protected $fillable = [
        'title', 'description'   
    ];

    public function enrollments(){
        return $this->hasMany('App\Enrollments');
    }
}
