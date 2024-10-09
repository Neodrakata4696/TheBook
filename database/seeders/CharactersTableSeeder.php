<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CharactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $names = ['素早い歩兵', '飛び回る小鳥', 'スプリッチ・ゴアー', 'ビッグブロックサウルス', '忍び寄るタン・キャッチャー'];
        
        foreach ($names as $name) {
            DB::table('characters')->insert([
                'name' => $name,
                'explain' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
