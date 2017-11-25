<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFm extends Model
{
    const SEX_UN = 10; // 常量：性别未知
    const SEX_BOY = 20; // 常量：性别男
    const SEX_GIRL = 30; // 常量：性别女

    protected  $table = 'student';

    // create方法需要设置批量赋值
    protected $fillable = ['name', 'age', 'sex'];

    public $timestamps = true;

    protected function getDateformat() {
        return time();
    }
//    protected  function asDateTime($val) {
//        return $val;
//    }

    public function getSex($ind = null) {
        $arr = [
            self::SEX_UN => "未知",
            self::SEX_BOY => "男",
            self::SEX_GIRL => "女",
        ];
        if($ind != null) {
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::SEX_UN];
        }
        return $arr;
    }
}