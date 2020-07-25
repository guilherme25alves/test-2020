<?php

namespace App\Helpers;

class FileToArrayHelper
{
    public function getCoursesListFromTextFile(){
        
        $coursesListArray = array();

        $coursesListFile = fopen(storage_path("coursesList.txt"), "r");
        
        while(!feof($coursesListFile)) {            
            array_push($coursesListArray, trim(strval(fgets($coursesListFile))) );
        }
        
        fclose($coursesListFile);
        
        return $coursesListArray;
    }
}