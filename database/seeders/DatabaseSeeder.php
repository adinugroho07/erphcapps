<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(15)->create();
        Role::factory(9)->create();

        DB::table('organization')->insert([
            'org_code' => 'VA01',
            'org_name' => 'Executive',
            'org_type' => 'Department',
            'position_title' => 'Founder',
            'position_code' => 'ZA01',
            'parent_org' => 0,
            'parent_org_code' => '',
            'ishead' => true,
            'havechild' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('organization')->insert([
            'org_code' => 'VB01',
            'org_name' => 'Sub Executive',
            'org_type' => 'Department',
            'position_title' => 'CEO',
            'position_code' => 'ZB01',
            'parent_org' => 1,
            'parent_org_code' => 'ZA01',
            'ishead' => false,
            'havechild' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('organization')->insert([
            'org_code' => 'VB01',
            'org_name' => 'Sub Executive',
            'org_type' => 'Department',
            'position_title' => 'Creative Director',
            'position_code' => 'ZB02',
            'parent_org' => 1,
            'parent_org_code' => 'ZA01',
            'ishead' => false,
            'havechild' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('organization')->insert([
            'org_code' => 'VC01',
            'org_name' => 'Support',
            'org_type' => 'Department',
            'position_title' => 'Support Function',
            'position_code' => 'ZD01',
            'parent_org' => 2,
            'parent_org_code' => 'VB01',
            'ishead' => false,
            'havechild' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('organization')->insert([
            'org_code' => 'VC02',
            'org_name' => 'Project',
            'org_type' => 'Department',
            'position_title' => 'Project Manager',
            'position_code' => 'ZD02',
            'parent_org' => 2,
            'parent_org_code' => 'VB01',
            'ishead' => false,
            'havechild' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('organization')->insert([
            'org_code' => 'VD01',
            'org_name' => 'Relations',
            'org_type' => 'Department',
            'position_title' => 'Client Relations',
            'position_code' => 'ZE01',
            'parent_org' => 3,
            'parent_org_code' => 'VB01',
            'ishead' => false,
            'havechild' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('organization')->insert([
            'org_code' => 'VE01',
            'org_name' => 'Designs',
            'org_type' => 'Department',
            'position_title' => 'Design Q & C',
            'position_code' => 'ZF01',
            'parent_org' => 3,
            'parent_org_code' => 'VB01',
            'ishead' => false,
            'havechild' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('organization')->insert([
            'org_code' => 'VEE01',
            'org_name' => 'Designs',
            'org_type' => 'Sub Department',
            'position_title' => 'Interior Design',
            'position_code' => 'ZF02',
            'parent_org' => 7,
            'parent_org_code' => 'VE01',
            'ishead' => false,
            'havechild' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('organization')->insert([
            'org_code' => 'VEE02',
            'org_name' => 'Designs',
            'org_type' => 'Sub Department',
            'position_title' => 'Drafter',
            'position_code' => 'ZF03',
            'parent_org' => 7,
            'parent_org_code' => 'VE01',
            'ishead' => false,
            'havechild' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);




    }
}
