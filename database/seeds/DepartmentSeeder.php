<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'department' => 'Organik'
        ]);
        DB::table('departments')->insert([
            'department' => 'Mitra'
        ]);
        DB::table('departments')->insert([
            'department' => 'Kontraktor'
        ]);
        DB::table('departments')->insert([
            'department' => 'Visitor'
        ]);
    }
}
