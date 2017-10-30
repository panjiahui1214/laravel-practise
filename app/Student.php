<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // 指定表名
    protected $table = 'student';
    // 指定主键
    protected $primaryKey = 'id';
    // 自动维护时间戳
    public $timestamps = true;

    // 时间戳以整型写入数据库
//    protected function getDateFormat()
//    {
//        return time();
//    }
    // 时间戳以原型返回
//    protected function asDateTime($val)
//    {
//        return $val;
//    }

    // 指定允许批量赋值的字段
    public $fillable = ['name', 'age'];
    // 指定不允许批量赋值的字段
    public $guarded = [];
}