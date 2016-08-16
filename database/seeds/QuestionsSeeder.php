<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<10; ++$i)
            Question::create([
                'content' => '单选'.($i+1),
                'type' => '0',
                'A' => 'A选项',
                'B' => 'B选项',
                'C' => 'C选项',
                'D' => 'D选项',
                'ans' => random_int(0, 3)
            ]);
        //
        for($i=0; $i<10; ++$i)
            Question::create([
                'content' => '判断'.($i+1),
                'type' => '1',
                'ans' => random_int(0, 1)
            ]);
    }
}
