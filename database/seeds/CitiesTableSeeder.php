<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // City テーブル に データを作成
        DB::table('cities')->insert([
            [
            	'name' => '安芸太田町（山県郡）',
            	'name_furi' => 'あきおおたちょう やまがたぐん',
            ],[
            	'name' => '安芸高田市',
            	'name_furi' => 'あきたかたし',
            ],[
            	'name' => '江田島市',
            	'name_furi' => 'えたじまし',
            ],[
            	'name' => '大崎上島町（豊田郡）',
            	'name_furi' => 'おおさきかみじまちょう とよたぐん',
            ],[
            	'name' => '大竹市',
            	'name_furi' => 'おおたけし',
            ],[
            	'name' => '尾道市',
            	'name_furi' => 'おのみちし',
            ],[
            	'name' => '海田町（安芸郡）',
            	'name_furi' => 'かいたちょう あきぐん',
            ],[
            	'name' => '北広島町（山県郡）',
            	'name_furi' => 'きたひろしまちょう やまがたぐん',
            ],[
            	'name' => '熊野町（安芸郡）',
            	'name_furi' => 'くまのちょう あきぐん',
            ],[
            	'name' => '呉市',
            	'name_furi' => 'くれし',
            ],[
            	'name' => '坂町（安芸郡）',
            	'name_furi' => 'さかちょう あきぐん',
            ],[
            	'name' => '庄原市',
            	'name_furi' => 'しょうばらし',
            ],[
            	'name' => '神石高原町（神石郡）',
            	'name_furi' => 'じんせきこうげんちょう じんせきぐん',
            ],[
            	'name' => '世羅町（世羅郡）',
            	'name_furi' => 'せらちょう せらぐん',
            ],[
            	'name' => '竹原市',
            	'name_furi' => 'たけはらし',
            ],[
            	'name' => '廿日市市',
            	'name_furi' => 'はつかいちし',
            ],[
            	'name' => '東広島市',
            	'name_furi' => 'ひがしひろしまし',
            ],[
            	'name' => '広島市',
            	'name_furi' => 'ひろしまし',
            ],[
            	'name' => '広島市安芸区',
            	'name_furi' => 'ひろしましあきく',
            ],[
            	'name' => '広島市安佐北区',
            	'name_furi' => 'ひろしましあさきたく',
            ],[
            	'name' => '広島市安佐南区',
            	'name_furi' => 'ひろしましあさみなみく',
            ],[
            	'name' => '広島市佐伯区',
            	'name_furi' => 'ひろしましさえきく',
            ],[
            	'name' => '広島市中区',
            	'name_furi' => 'ひろしましなかく',
            ],[
            	'name' => '広島市西区',
            	'name_furi' => 'ひろしましにしく',
            ],[
            	'name' => '広島市東区',
            	'name_furi' => 'ひろしましひがしく',
            ],[
            	'name' => '広島市南区',
            	'name_furi' => 'ひろしましみなみく',
            ],[
            	'name' => '福山市',
            	'name_furi' => 'ふくやまし',
            ],[
            	'name' => '府中市',
            	'name_furi' => 'ふちゅうし',
            ],[
            	'name' => '府中町（安芸郡）',
            	'name_furi' => 'ふちゅうちょう あきぐん',
            ],[
            	'name' => '三原市',
            	'name_furi' => 'みはらし',
            ],[
            	'name' => '三次市',
            	'name_furi' => 'みよしし',
            ],
        ]);
    }
}
