<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permit_types')->insert([
            'permit_name' => 'CSMS',
        ]);
        DB::table('permit_types')->insert([
            'permit_name' => 'JSA',
        ]);
        DB::table('permit_types')->insert([
            'permit_name' => 'HSE PLAN',
        ]);
        DB::table('permit_types')->insert([
            'permit_name' => 'Form Permit',
        ]);
    }
}
