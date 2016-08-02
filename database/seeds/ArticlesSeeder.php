<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<20; ++$i) {
            Article::create([
                'uid'=>rand(1, 3),
                'cid'=>rand(1, 6),
                'title'=>'标题'.$i,
                'content'=>'内容'.$i
            ]);
        }
        //
    }
}
