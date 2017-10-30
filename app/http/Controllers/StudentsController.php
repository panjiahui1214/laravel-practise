<?php
// artisan创建命令：php artisan make:controller StudentsController
namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{
    //
    public function upload(Request $request)
    {
        if($request->isMethod('POST')){
            //var_dump($_FILES);
            $file = $request->file('source');

            // 判断文件是否上传成功
            if($file->isValid()){
                //获取文件的原文件名
                $originalName = $file->getClientOriginalName();
                //获取文件的扩展名
                $extName = $file->getClientOriginalExtension();
                //获取文件的类型
                $fileType = $file->getClientMimeType();
                //获取临时文件的绝对路径
                $realPath = $file->getRealPath();

                // uniqid:生成一个唯一的ID
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $extName;
                // disk(参数)要与filesystem.php中的参数一致
                $bool = Storage::disk('upload')->put($filename, file_get_contents($realPath));
                var_dump($bool);
            }
            exit;
        }
        return view('students.upload');
    }

    public function mail()
    {
        /*
        Mail::raw('邮件内容 测试', function($message) {
            $message->from('ynh12140@163.com', 'PJH');
            $message->subject('邮件主题 测试');
            $message->to('1300135503@qq.com');
        });
        */

        Mail::send('students.mail', ['name'=>'jane'], function($message) {
            $message->to('1300135503@qq.com');
        });
    }

    public function cache1()
    {
        // put(键值, 值, 有效期(分钟)):保存对象到缓存中
//        Cache::put('key1', 'val1', 10);

        // add(键值, 值, 有效期(分钟)):如对象已存在，添加失败，否则添加成功
//        $bool = Cache::add('key2', 'val2', 10);
//        var_dump($bool);

        // forever(键值, 值):永久保留在缓存中
//        Cache::forever('key3', 'val3');

        // has(键值):判断缓存是否存在
        if(Cache::has('key1')) {
            $val = Cache::get('key1');
            var_dump($val);
        } else {
            echo 'not exist';
        }
    }
    // 缓存数据在storage/framework/cache/data中
    public function cache2()
    {
        // get(键值):从缓存中获取对象
//        $val = Cache::get('key3');

        // pull():从缓存中获取对象并删除（第一次执行返回缓存值，第二次执行返回null）
//        $val = Cache::pull('key3');
//        var_dump($val);

        // forget():从缓存中删除对象
        $bool = Cache::forget('key1');
        var_dump($bool);
    }

    public function error()
    {
        /**
         * 如view不存在，debug为false，则只提示出错，不提示具体出错原因
         * 上线时需设置debug为false,以此避免被别人知晓bug并攻击
         **/
//        return view('students.error');

        // 调用view/errors/503.blade.php
//        abort('503');
        // 如有配置404.blade.php页面，则找不到页面时都自动调用404.blade.php

//        Log::info('这是一个info级别的日志');
//        Log::warning('这是一个warning级别的日志');
        Log::error('这是一个数组', ['name'=>'jane', 'age'=>25]);
        // 当.env中的APP_LOG设置为daily时，生成的日志文件中则包含当天日期
    }

    public function queue()
    {
        // 把任务推送到到队列中（jobs表中也会新增记录）
        dispatch(new SendEmail('1300135503@qq.com'));
    }
}
