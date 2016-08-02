<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "name" => '系统提示',
        ]);
        Category::create([
            "name" => '最新公告',
        ]);
        Category::create([
            "name" => '规章制度',
        ]);
        Category::create([
            "name" => '事故案例',
        ]);
        Category::create([
            "name" => '安全标识',
        ]);
        Category::create([
            "name" => '安全讲座',
        ]);
        //
    }
}
