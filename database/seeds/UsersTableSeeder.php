<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Department;

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

        $adminRole = Role::where('type', 'admin')->first();
        $department = Department::where('name', 'MIS')->first();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@amwire.com.ph',
            'password' => Hash::make('admin'),
            'status' => 'approved'
        ])->department()->associate($department);

        $admin->save();    
        $admin->roles()->attach($adminRole);
        

        $treasury = User::create([
            'name' => 'Treasury',
            'email' => 'treasury@amwire.com.ph',
            'password' => Hash::make('treasury'),
            'status' => 'approved'
        ])->department()->associate(Department::where('name', 'Treasury')->first());
        $treasury->save();

        $treasury->roles()->attach(Role::where('type', 'approver')->first());
    }
}
