<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * モデルのデフォルト状態を定義する。
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 名前: Fakerを使用してランダムな名前を生成
            'name' => $this->faker->name(),
            // メールアドレス: Fakerを使用してランダムなメールアドレスを生成
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            // パスワード: ハッシュ化されたパスワードを設定
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // リメンバートークン: ランダムな文字列を生成
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * モデルのメールアドレスを未確認状態にする。
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
