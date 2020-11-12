<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('governs')->insert([
            ['name' => 'القاهره' ],
            ['name' => 'الجيزة'],
            ['name' => 'القليوبيه'],
            ['name' => 'اﻹسكندريه'],
            ['name' => 'البحيرة'],
            ['name' => 'مطروح'],
            ['name' => 'دمياط'],
            ['name' => 'الدقهليه'],
            ['name' => 'كفر الشيخ'],
            ['name' => 'الغربية'],
            ['name' => 'المنوفية'],
            ['name' => 'الشرقية'],
            ['name' => 'بورسعيد'],
            ['name' => 'اﻹسماعليه'],
            ['name' => 'السويس'],
            ['name' => 'شمال سيناء'],
            ['name' => 'جنوب سيناء'],
            ['name' => 'بني سويف'],
            ['name' => 'الفيوم'],
            ['name' => 'المنيا'],
            ['name' => 'أسيوط'],
            ['name' => 'الوادي الجديد'],
            ['name' => 'البحر اﻷحمر '],
            ['name' => 'سوهاج'],
            ['name' => 'قنا'],
            ['name' => 'اﻷقصر'],
            ['name' => 'أسوان'],


        ]);
    }
}
