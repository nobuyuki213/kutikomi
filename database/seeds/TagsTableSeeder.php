<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tag テーブルに データを作成
        DB::table('tags')->inseet([
        	[
        		'name' => '一日中遊べる',
        	],[
        		'name' => '何度行っても楽しめる',
        	],[
        		'name' => 'キッズスペースあり',
        	],[
        		'name' => '要予約',
        	],[
        		'name' => 'ランチ',
        	],[
        		'name' => 'ディナー',
        	],[
        		'name' => '雨の日でもOK',
        	],[
        		'name' => '無料で遊べる',
        	],[
        		'name' => '動物とふれあう',
        	],[
        		'name' => '自然とふれあう',
        	],[
        		'name' => 'ゆっくりと楽しむ',
        	],
        ]);
    }
}
