<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Model\Role;
class RoleUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->roles()->attach(Role::inRandomOrder()->first()->id);
        }
    }
}
