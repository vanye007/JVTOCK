<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Roles;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::truncate();
      DB::table('role_user')->truncate();

      $adminRole = Role::where('name','admin')->first();
      $authorRole = Role::where('name','author')->first();
      $userRole = Role::where('name','user')->first();
    }
}
