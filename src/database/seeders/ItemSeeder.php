<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //テストユーザー１
        $item1 = \App\Models\Item::create([
            'user_id' => 1,
            'name' => '腕時計',
            'price' => 15000,
            'brand_name' => 'Rolax',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition_id' => 1,
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
        ]);
        $item1->categories()->attach([
            1,
            5
        ]);

        $item2 = \App\Models\Item::create([
            'user_id' => 1,
            'name' => 'HDD',
            'price' => 5000,
            'brand_name' => '西芝',
            'description' => '高速で信頼性の高いハードディスク',
            'condition_id' => 2,
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
        ]);
        $item2->categories()->attach([
            2,
        ]);

        $item3 = \App\Models\Item::create([
            'user_id' => 1,
            'name' => '玉ねぎ3束',
            'price' => 300,
            'brand_name' => null,
            'description' => '新鮮な玉ねぎ3束のセット',
            'condition_id' => 3,
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
        ]);
        $item3->categories()->attach([
            10,
        ]);

        $item4 = \App\Models\Item::create([
            'user_id' => 1,
            'name' => '革靴',
            'price' => 4000,
            'brand_name' => null,
            'description' => 'クラシックなデザインの革靴',
            'condition_id' => 4,
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
        ]);
        $item4->categories()->attach([
            1,
            5,
        ]);

        $item5 = \App\Models\Item::create([
            'user_id' => 1,
            'name' => 'ノートPC',
            'price' => 45000,
            'brand_name' => null,
            'description' => '高性能なノートパソコン',
            'condition_id' => 1,
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
        ]);
        $item5->categories()->attach([
            2,
        ]);

        //テストユーザー２
        $item6 = \App\Models\Item::create([
            'user_id' => 2,
            'name' => 'マイク',
            'price' => 8000,
            'brand_name' => null,
            'description' => '高音質のレコーディング用マイク',
            'condition_id' => 2,
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
        ]);
        $item6->categories()->attach([
            2,
        ]);

        $item7 = \App\Models\Item::create([
            'user_id' => 2,
            'name' => 'ショルダーバッグ',
            'price' => 3500,
            'brand_name' => null,
            'description' => 'おしゃれなショルダーバッグ',
            'condition_id' => 3,
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
        ]);
        $item7->categories()->attach([
            1,
            4,
        ]);

        $item8 = \App\Models\Item::create([
            'user_id' => 2,
            'name' => 'タンブラー',
            'price' => 500,
            'brand_name' => null,
            'description' => '使いやすいタンブラー',
            'condition_id' => 4,
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
        ]);
        $item8->categories()->attach([
            10,
        ]);

        $item9 = \App\Models\Item::create([
            'user_id' => 2,
            'name' => 'コーヒーミル',
            'price' => 4000,
            'brand_name' => 'Starbacks',
            'description' => '手動のコーヒーミル',
            'condition_id' => 1,
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
        ]);
        $item9->categories()->attach([
            10,
        ]);

        $item10 = \App\Models\Item::create([
            'user_id' => 2,
            'name' => 'メイクセット',
            'price' => 2500,
            'brand_name' => null,
            'description' => '便利なメイクアップセット',
            'condition_id' => 2,
            'image_url' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
        ]);
        $item10->categories()->attach([
            1,
            4,
            6,
        ]);
    }
}
