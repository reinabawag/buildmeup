<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create(['type' => 'admin']);
        Role::create(['type' => 'approver']);
        Role::create(['type' => 'user']);
    }
}
