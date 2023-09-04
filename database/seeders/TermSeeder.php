<?php

namespace Database\Seeders;

use App\Models\Termcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $termcategories = array(
            array('id' => '1','title' => 'Tag 1','slug' => 'tag-1','type' => 'tags','status' => '1','created_at' => '2023-05-28 14:15:50','updated_at' => '2023-05-28 14:15:50'),
            array('id' => '2','title' => 'Tag 1','slug' => 'tag-1','type' => 'tags','status' => '1','created_at' => '2023-05-28 14:15:56','updated_at' => '2023-05-28 14:15:56'),
            array('id' => '3','title' => 'Tag 3','slug' => 'tag-3','type' => 'tags','status' => '1','created_at' => '2023-05-28 14:16:03','updated_at' => '2023-05-28 14:16:03'),
            array('id' => '4','title' => 'Category 1','slug' => 'category-1','type' => 'category','status' => '1','created_at' => '2023-05-28 14:16:15','updated_at' => '2023-05-28 14:16:15'),
            array('id' => '5','title' => 'Category 2','slug' => 'category-2','type' => 'category','status' => '1','created_at' => '2023-05-28 14:16:22','updated_at' => '2023-05-28 14:16:22'),
            array('id' => '6','title' => 'Category 3','slug' => 'category-3','type' => 'category','status' => '1','created_at' => '2023-05-28 14:16:29','updated_at' => '2023-05-28 14:16:29')
        );

        Termcategory::insert($termcategories);
    }
}
