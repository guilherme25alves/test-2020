<?php

use Illuminate\Database\Seeder;

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

        $this->call(StudentsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(EnrollmentsTableSeeder::class);

        DB::statement('set foreign_key_checks = 1');
        Model::reguard();
    }
}
