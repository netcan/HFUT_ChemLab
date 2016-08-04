<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    public function articles() {
        return $this->hasMany('App\Article', 'cid', 'id');
    }
    public static $base = [
        '系统提示',
        '最新公告',
        '规章制度',
        '事故案例',
        '安全标识',
        '安全讲座',
    ];

    //
}
