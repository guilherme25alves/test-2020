<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = "students";

    protected $primaryKey = "student_id";

    protected $fillable = [
        'name', 'email', 'birthdate'    
    ];

    public function enrollments(){
        return $this->hasMany('App\Enrollments');
    }
}
