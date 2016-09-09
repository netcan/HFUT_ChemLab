<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $uid
 * @property boolean $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereType($value)
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'name', 'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $type = [
        'admin' => 0,
        'teacher' => 1,
        'student' => 2
    ];

    public static $typeName = [
        '管理员',
        '教师',
        '学生'
    ];

    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    public  function isAdmin() {
        return $this->type === User::$type['admin'];
    }
    public function isTeacher() {
        return $this->type === User::$type['teacher'];
    }
    public function isStudent() {
        return $this->type === User::$type['student'];
    }
    public function articles() {
        return $this->hasMany('App\Article', 'cid', 'id');
    }

    public function papers() {
        return $this->belongsToMany('App\Paper', 'user_paper', 'uid', 'pid')
            ->withPivot('start_time', 'end_time', 'score');
    }

    public function questions() {
        return $this->belongsToMany('App\Question', 'user_question', 'uid', 'qid')
            ->withPivot('qid', 'ans');
    }
    public function questions_pid() {
        return $this->belongsToMany('App\Question', 'user_question', 'uid', 'pid')
            ->withPivot('qid', 'ans');
    }

    public static function getType($type) {
        return User::$typeName[$type];
    }
}
