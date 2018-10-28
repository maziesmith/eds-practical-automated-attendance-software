<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //note: change date pending on when you want to test for attendance working
        $user = App\event::create([
            'name' => 'Chapel Service',
            'start' => '2018-10-27',
            'end' => '2018-10-27'
        ]);
    }
}
