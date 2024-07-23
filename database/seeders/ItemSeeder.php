<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(){
        DB::table('items')->insert([
            ['name'=>'愛知1','image'=>'aiti1.jpg','comment'=>'きれいです','price'=>100,'genre'=>'愛知'],
            ['name'=>'愛知2','image'=>'aiti2.jpg','comment'=>'景色がきれい','price'=>300,'genre'=>'愛知'],
            ['name'=>'愛知3','image'=>'aiti3.jpg','comment'=>'いい感じ','price'=>700,'genre'=>'愛知'],
            ['name'=>'京都1','image'=>'kyouto1.jpg','comment'=>'いい感じ','price'=>300,'genre'=>'京都'],
            ['name'=>'京都2','image'=>'kyouto2.jpg','comment'=>'きれいな景色です。とてもいいと思います。今回購入しました。','price'=>200,'genre'=>'京都'],
            ['name'=>'京都3','image'=>'kyouto3.jpg','comment'=>'きれい','price'=>100,'genre'=>'京都'],
            ['name'=>'京都4','image'=>'kyouto4.jpg','comment'=>'京都の景色','price'=>1000,'genre'=>'京都'],
            ['name'=>'京都5','image'=>'kyouto5.jpg','comment'=>'京都の景色いい感じ','price'=>500,'genre'=>'京都'],
            ['name'=>'京都6','image'=>'kyouto6.jpg','comment'=>'とてもいい','price'=>700,'genre'=>'京都'],
            ['name'=>'京都7','image'=>'kyouto7.jpg','comment'=>'ぜひ手にとってみてください','price'=>200,'genre'=>'京都'],
            ['name'=>'三重1','image'=>'mie1.jpg','comment'=>'いい感じ','price'=>700,'genre'=>'三重'],
            ['name'=>'三重2','image'=>'mie2.jpg','comment'=>'きれいな景色です。とてもいいと思います。今回購入しました。','price'=>300,'genre'=>'三重'],
            ['name'=>'三重3','image'=>'mie3.jpg','comment'=>'きれい','price'=>200,'genre'=>'三重'],
            ['name'=>'三重4','image'=>'mie4.jpg','comment'=>'景色がきれい','price'=>500,'genre'=>'三重'],
            ['name'=>'三重5','image'=>'mie5.jpg','comment'=>'いい感じ','price'=>100,'genre'=>'三重'],
            ['name'=>'奈良1','image'=>'nara1.jpg','comment'=>'いい感じ','price'=>400,'genre'=>'奈良'],
            ['name'=>'奈良2','image'=>'nara2.jpg','comment'=>'きれい','price'=>500,'genre'=>'奈良'],
            ['name'=>'奈良3','image'=>'nara3.jpg','comment'=>'これはいい','price'=>700,'genre'=>'奈良'],
            ['name'=>'奈良4','image'=>'nara4.jpg','comment'=>'すてき','price'=>800,'genre'=>'奈良'],
            ['name'=>'奈良5','image'=>'nara5.jpg','comment'=>'最高','price'=>900,'genre'=>'奈良'],
            ['name'=>'滋賀1','image'=>'siga1.jpg','comment'=>'景色がきれい','price'=>200,'genre'=>'滋賀'],
            ['name'=>'滋賀2','image'=>'siga2.jpg','comment'=>'いい感じ','price'=>1000,'genre'=>'滋賀'],
            ['name'=>'滋賀3','image'=>'siga3.jpg','comment'=>'きれい','price'=>500,'genre'=>'滋賀'],
            ['name'=>'滋賀4','image'=>'siga4.jpg','comment'=>'これはいい','price'=>700,'genre'=>'滋賀'],
            ['name'=>'東京1','image'=>'toukyou1.jpg','comment'=>'景色がきれい','price'=>800,'genre'=>'東京'],
            ['name'=>'東京2','image'=>'toukyou2.jpg','comment'=>'いい感じ','price'=>200,'genre'=>'東京'],
            ['name'=>'和歌山1','image'=>'wakayama1.jpg','comment'=>'海がきれい','price'=>900,'genre'=>'和歌山'],
            ['name'=>'和歌山2','image'=>'wakayama2.jpg','comment'=>'すばらしい','price'=>200,'genre'=>'和歌山'],
            ['name'=>'和歌山3','image'=>'wakayama3.jpg','comment'=>'すてきな景色です','price'=>1000,'genre'=>'和歌山'],          
        ]);
    }
}