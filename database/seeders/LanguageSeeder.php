<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'English', 'code' => 'en', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bangla', 'code' => 'bn', 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ];

        Language::insert($languages);
    }
}
