<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
           DB::table('settings')->insert([
                ['id'=>1,'title' => 'member', 'status' => 'Active'],
                ['id'=>2,'title' => 'service', 'status' => 'Active'],
                ['id'=>3,'title' => 'expense', 'status' => 'Active'],
                ['id'=>4,'title' => 'invoice', 'status' => 'Active'],
                ['id'=>5,'title' => 'logo', 'status' => 'Active'],
              
            ]);
    }
}
