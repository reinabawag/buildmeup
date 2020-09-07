<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Department::truncate();
        App\Department::create(['name' => 'MIS']);
        App\Department::create(['name' => 'Credit & Collection']);
        App\Department::create(['name' => 'Sales']);
        App\Department::create(['name' => 'QA']);
        App\Department::create(['name' => 'Cost Accounting']);
        App\Department::create(['name' => 'Stockroom']);
        App\Department::create(['name' => 'PPMC']);
        App\Department::create(['name' => 'Treasury']);
    }
}
