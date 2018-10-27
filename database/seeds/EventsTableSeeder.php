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
        //
        $user = App\event::create([
            'name' => 'Chapel Service',
            'start' => '2018-10-27',
            'end' => '2018-10-27'
        ]);
    }
}
