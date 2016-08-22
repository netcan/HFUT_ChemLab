<?php

use Illuminate\Database\Seeder;
use App\Paper;

class PapersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<10; ++$i)
            Paper::create([
                'title' => '试卷'.$i,
                'multi_score' => 2,
                'judge_score' => 1,
                'time' => 2333,
                'start_time' => \Carbon\Carbon::createFromDate(2016,8,21)->toDateTimeString(),
                'end_time' => \Carbon\Carbon::createFromDate(2099,8,21)->toDateTimeString(),
            ]);
        //
    }
}
