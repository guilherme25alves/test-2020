<?php

use Illuminate\Database\Seeder;

class EnrollmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Enrollments::truncate();

        factory(App\Enrollments::class, 45)->create();
    }
}
