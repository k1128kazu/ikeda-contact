<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // ▼ 外部キー整合性のため順序を保証
        $this->call([
            CategorySeeder::class,
            ContactSeeder::class,
        ]);
    }
}
