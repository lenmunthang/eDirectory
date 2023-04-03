<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\JudicialOfficers;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        JudicialOfficers::create([
            'jo_code' => '3',
            'jo_title' => 'Mr',
            'jo_first_name' => 'John',
            'jo_middle_name' => 'M',
            'jo_last_name' => 'Doe',
            'jo_name' => 'John M Doe',
            'jo_photo' => 'John photo',
            'jo_grade' => 2,
            'jo_priority' => 3,
            'jo_designation' => 'Designation',
            'jo_mslsa' => '1',
            'jo_msja' => '0',
            'jo_pop_district' => 'District',
            'jo_pop_sub_div' => 'Sub Div',
            'jo_dob' => '2022-01-01',
            'jo_qualification' => 'Qualification',
            'jo_doa' => '2022-02-01',
            'jo_dob' => '2022-03-01',
            'jo_display' => 'Y',
            'jo_telephone_no' => '8414803341',
            'jo_fax_no' => '8414803341',
            'jo_mobile_no' => '8414803341',
            'jo_email_id' => 'john@gmail.com'
        ]);

    }
}
