<?php

use Illuminate\Database\Seeder;
use App\Helpers\FileToArrayHelper;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {    
        Model::unguard();
        DB::statement('set foreign_key_checks = 0');
        
        $faker = Faker\Factory::create();

        $fileHelper = new FileToArrayHelper;

        $listCourses = $fileHelper->getCoursesListFromTextFile();

        $this->call(StudentsTableSeeder::class);

        App\Courses::truncate();

        for ($i=0; $i < count($listCourses); $i++) {             
            App\Courses::create([
                'title' => $listCourses[$i],
                'description' => $faker->sentence()
            ]);
        }
                    
        $this->call(EnrollmentsTableSeeder::class);

        DB::statement('set foreign_key_checks = 1');
        Model::reguard();
    }
}
