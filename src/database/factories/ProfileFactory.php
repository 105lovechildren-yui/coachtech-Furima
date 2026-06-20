<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // ニックネーム: Fakerを使用してランダムなユーザー名を生成
            'nickname' => $this->faker->userName(),
            // プロフィール画像: Fakerを使用してランダムな画像URLを生成
            'profile_image' => null, // 画像は後でアップロードするため、初期値はnullに設定
            // 郵便番号: Fakerを使用してランダムな郵便番号を生成
            'postal_code' => $this->faker->numerify('###-####'),
            // 住所: Fakerを使用してランダムな住所を生成
            'address' => $this->faker->address(),
            // 建物名: Fakerを使用してランダムな建物名を生成
            'building' => $this->faker->optional()->secondaryAddress(),
        ];
    }
}
