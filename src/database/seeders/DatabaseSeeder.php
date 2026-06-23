<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Condition、Category、User、ItemのSeederを実行する。
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ConditionSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            ItemSeeder::class,
        ]);
    }
}
