<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        App\Students::truncate();
    
        factory(App\Students::class, 50)->create();
    }
}
