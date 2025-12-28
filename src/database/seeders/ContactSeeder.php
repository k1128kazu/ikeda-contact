<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        // 件数は必要に応じて調整（例：30件）
        Contact::factory()->count(30)->create();
    }
}
