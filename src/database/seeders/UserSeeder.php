<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //出品者テストユーザー１
        $user1 = \App\Models\User::factory()->create([
            'name' => 'テスト 太郎',
            'email' => 'seller1@example.com',
            'password' => bcrypt('password'),
        ]);

        //出品テストユーザーのプロフィール
        \App\Models\Profile::factory()->create([
            'user_id' => $user1->id,
            'nickname' => 'テスト 太郎',
        ]);

        //出品者テストユーザー２
        $user2 = \App\Models\User::factory()->create([
            'name' => 'テスト 花子',
            'email' => 'seller2@example.com',
            'password' => bcrypt('password'),
        ]);

        //出品テストユーザー２のプロフィール
        \App\Models\Profile::factory()->create([
            'user_id' => $user2->id,
            'nickname' => 'テスト 花子',
        ]);

        //購入者テストユーザー
        $user3 = \App\Models\User::factory()->create([
            'name' => 'テスト 購太',
            'email' => 'buyer@example.com',
            'password' => bcrypt('password'),
        ]);

        //購入者テストユーザーのプロフィール
        \App\Models\Profile::factory()->create([
            'user_id' => $user3->id,
            'nickname' => 'テスト 購太',
        ]);
    }
}
