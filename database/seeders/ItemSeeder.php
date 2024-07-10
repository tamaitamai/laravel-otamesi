<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(){
        DB::table('items')->insert([
            ['name' => 'アイテム1','comment' => 'コメント1','image'=>'aoyama1.jpg','price'=>200],
            ['name' => 'アイテム2','comment' => 'コメント2','image'=>'ikoma-damu1.jpg','price'=>100],
            ['name' => 'アイテム3','comment' => 'コメント3','image'=>'mie-park1.jpg','price'=>500],
        ]);
    }
}