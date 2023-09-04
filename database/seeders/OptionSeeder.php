<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            // SEO DATA
            ['key' => 'seo_home','value' => '{"site_name":"Home","tag":"Home","site_title":"home", "description":"In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content."}','lang' => 'en','created_at' => now(),'updated_at' => now()],
            ['key' => 'seo_blog','value' => '{"site_name":"Blog","tag":"Blog","site_title":"Blog", "description":"In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content."}','lang' => 'en','created_at' => now(),'updated_at' => now()],
            ['key' => 'seo_service','value' => '{"site_name":"Service","tag":"Service","site_title":"Service", "description":"In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content."}','lang' => 'en','created_at' => now(),'updated_at' => now()],
        ];

        Option::insert($options);
    }
}
