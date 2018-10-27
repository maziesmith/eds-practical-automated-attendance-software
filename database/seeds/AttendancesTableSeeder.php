<?php

use Illuminate\Database\Seeder;
use App\user;
use App\attendance;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $students = user::getStudentsIdentification(60);

        foreach($students as $student_id) {
            attendance::create([
                'event_id' => '1',
                'student_id' => $student_id->identification,
            ]);
        }
    }
}
