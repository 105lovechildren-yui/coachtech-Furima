<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 支払い方法: Fakerを使用してランダムな支払い方法を生成
            'payment_method' => $this->faker->randomElement([
                'credit_card',
                'convenience_store',
            ]),
            // 配送先郵便番号: Fakerを使用してランダムな郵便番号を生成
            'shipping_postal_code' => $this->faker->numerify('###-####'),
            // 配送先住所: Fakerを使用してランダムな住所を生成
            'shipping_address' => $this->faker->address(),
            // 配送先建物名: Fakerを使用してランダムな建物名を生成
            'shipping_building' => $this->faker->secondaryAddress(),
        ];
    }
}
