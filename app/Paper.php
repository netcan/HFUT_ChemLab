<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = [
        'title', 'multi_score', 'judge_score', 'time', 'start_time', 'end_time'
    ];
    public function questions() {
        return $this->belongsToMany('App\Question', 'paper_question', 'pid', 'qid')
            ->withTimestamps();
    }
    public function users() {
        return $this->belongsToMany('App\Question', 'user_paper', 'pid', 'uid');
    }
}
