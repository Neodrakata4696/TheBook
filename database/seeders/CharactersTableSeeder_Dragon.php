<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CharactersTableSeeder_Dragon extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('characters')->insert([
            'name' => '孫悟空',
            'explain' => 'おっす！オラ悟空！',
            'descript' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
