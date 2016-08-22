<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Question
 *
 * @property integer $id
 * @property string $content
 * @property integer $type
 * @property string $A
 * @property string $B
 * @property string $C
 * @property string $D
 * @property integer $ans
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereA($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereB($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereC($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereD($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereAns($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Question extends Model
{
    public static $Ans = ['A', 'B', 'C', 'D', '正确', '错误'];
    public static $Type = ['单选', '判断'];

    protected $fillable = [
      'content', 'type', 'A', 'B', 'C', 'D', 'ans'
    ];

    public function papers() {
        return $this->belongsToMany('App\Paper', 'paper_question', 'pid', 'qid')
            ->withTimestamps();
    }
}
