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
        foreach (Category::$base as $name) {
            Category::create([
                'name' => $name,
            ]);
        }
        //
    }
}
