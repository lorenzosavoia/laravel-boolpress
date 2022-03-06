<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) { 
            $newUser = new User();
            $newUser->name = $faker->name();
            $newUser->email = $faker->email();
            $string = '123_FC78';
            $newUser->password = Hash::make($string);
            $newUser->save();
        }
    }
}
