<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\user::create([
            'name' => 'Fanan Dala',
            'identification' => "CU1001" ,
            'email' => 'fanan123@yahoo.com',
            'password' => 'fanan123',
            'role' => 'admin'
        ]);

        //seed students
        factory(App\user::class, 100)->create();
    }
}
