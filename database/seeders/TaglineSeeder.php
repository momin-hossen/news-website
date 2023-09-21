<?php

namespace Database\Seeders;

use App\Models\Tagline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaglineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagline = [
            ['name' => 'hello1', 'status' => 1,],
            ['name' => 'hello2', 'status' => 0,],
        ];

        Tagline::insert($tagline);
    }
}
