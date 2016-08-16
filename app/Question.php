<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public static $Ans = ['A', 'B', 'C', 'D', '正确', '错误'];

    protected $fillable = [
      'content', 'type', 'A', 'B', 'C', 'D', 'ans'
    ];
    //
}
