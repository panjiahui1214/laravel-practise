<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function test1()
    {
        //return 'test1';
//        $student = DB::select('select * from student');
//        dd($student);

//        $bool = DB::insert('insert into student(name, age) values(?, ?)',
//              ['imooc', 18]);
//        var_dump($bool);

//        $num = DB::update('update student set age = ? where name = ?',
//             [23, 'jane']);
//        var_dump($num);

        $num = DB::delete('delete from student where id > ?',
                [1]);
        var_dump($num);
    }

    /* 使用查询构造器新增数据 */
    public function query1()
    {
//        $bool = DB::table('student')->insert(
//            ['name' => 'imooc', 'age' => 18]
//        );
//        var_dump($bool);

        /* 插入语句，并返回其自增id值 */
        $id = DB::table('student')->insertGetId(
                ['name' => 'imooc2', 'age' => 23]
        );
        var_dump($id);
    }

    /* 使用查询构造器更新数据 */
    public function query2()
    {
//        $num = DB::table('student')
//             ->where('id', 3)
//             ->update(['name' => 'imooc1']);
//        var_dump($num);

        /* increment(a, b):给a字段的值自动增加b,b默认为1 */
        //$num = DB::table('student')->increment('age');
        //$num = DB::table('student')->increment('age', 3);
        /* decrement(a, b):给a字段的值自动减少b,b默认为1 */
        //$num = DB::table('student')->decrement('age', 3);
        $num = DB::table('student')
            ->where('id', 3)
            ->decrement('age', 2, ['name' => 'iimooc']);
        var_dump($num);
    }

    /* 使用查询构造器删除数据 */
    public function query3()
    {
//        $num = DB::table('student')
//            ->where('id', 3)
//            ->delete();
//        $num = DB::table('student')
//            ->where('id', '>=', 3)
//            ->delete();

        /* truncate:清空表数据 */
        DB:table('student')->truncate();
        var_dump($num);
    }

    /* 使用查询构造器查询数据 */
    public function query4()
    {
//        $bool = DB::table('student')->insert([
//            ['id' => 3,'name' => 'name2','age' => 16],
//            ['id' => 4,'name' => 'name3','age' => 18],
//            ['id' => 5,'name' => 'name4','age' => 20],
//            ['id' => 6,'name' => 'name5','age' => 22]
//        ]);
//        var_dump($bool);

        /* get():获取表的所有数据 */
        //$students = DB::table('student')->get();

        /* first(): 获取查询出来的第一条数据 */
//        $students = DB::table('student')
//            ->orderBy('id', 'desc')
//            ->first();

        /* where():单个条件 */
//        $students = DB::table('student')
//            ->where('id', '>=', 3)
//            ->get();
        /* whereRaw():多个条件 */
//        $students = DB::table('student')
//            ->whereRaw('id > ? and age < ?', [3, 22])
//            ->get();

        /* pluck():返回表中某个字段 */
//        $names = DB::table('student')
//            ->pluck('name');

        /* select():返回查询指定字段 */
//        $students = DB::table('student')
//            ->select('id', 'name', 'age')
//            ->get();

        /* chunk(a, b):每次获取a条数据（分块传输），必须使用orderBy，否则报错 */
        echo '<pre>';
        DB::table('student')->orderBy('id', 'asc')->chunk(2, function($students) {
            var_dump($students);
            return false;// 用于停止chunk。用于条件语句中
        });
        //dd($students);
    }

    /* 查询构造器中的聚合函数 */
    public function query5() {
        /* count():返回统计条数 */
//        $num = DB::table('student')->count();
//        var_dump($num);

        /* max():返回指定字段最大值 */
//        $max = DB::table('student')->max('age');
//        var_dump($max);
        /* min():返回指定字段最小值 */
//        $min = DB::table('student')->min('age');
//        var_dump($min);

        /* avg():返回指定字段平均值*/
//        $avg = DB::table('student')->avg('age');
//        var_dump($avg);

        /* sum():返回指定字段总和*/
        $sum = DB::table('student')->sum('age');
        var_dump($sum);
    }

    public function orm1() {
        /* all():查询所有记录 */
//        $students = Student::all();

        /* find(a):查询主键值为a的记录，无此记录时则返回NULL */
//        $student = Student::find(1);
        /* findOrFail(a):查询主键值为a的记录，无此记录时则报错 */
        $student = Student::findOrFail(10);
        var_dump($student);
    }

    public function orm2() {
//        $student = new Student();
//        $student->name = 'jane3';
//        $student->age = 26;
//        $bool = $student->save();
//        dd($bool);

//        $student = Student::find(11);
//        //echo $student->created_at;
//        echo date('Y-m-d H:i:s', $student->created_at);

        /* 使用模型的create方法新增数据 */
//        $student = Student::create(
//            ['name' => 'imooc', 'age' => 18]
//        );
//        dd($student);

        /* firstOrCreate():以属性查找，如没有则新增记录 */
//        $student = Student::firstOrCreate(
//            ['name' => 'imooc1']
//        );
        /* firstOrNew():以属性查找，如没有则新增实例，需要保存请自行调用save() */
        $student = Student::firstOrNew(
            ['name' => 'imooc2']
        );
        $bool = $student->save();
        dd($bool);
    }

    public function orm3() {
        /* 使用模型更新数据 */
//        $student = Student::find(15);
//        $student->name = 'kid';
//        $bool = $student->save();
//        var_dump($bool);

        $num = Student::where('id', '>', 13)->update(
            ['age' => 20]
        );
        var_dump($num);
    }

    public function orm4() {
        /* 使用模型删除数据 */
//        $student = Student::find(14);
//        $bool = $student->delete();
//        var_dump($bool);

        /* 使用主键删除数据 */
//        $num = student::destroy(15);
//        var_dump($num);

        $num = Student::where('id', '>', 11)->delete();
        var_dump($num);
    }

    public function section1() {
        $students = Student::where('id', '>', 20)->get();
        $name   =   'jane1';
        $arr    =   ['jane', 'imooc'];

        return view('student.section1',[
            'name'      =>  $name,
            'arr'       =>  $arr,
            'students'   =>  $students
        ]);
    }

    public function urlTest() {
        return 'urlTest';
    }

    public function request1(Request $request) {
        /* 1、取值 */
        //echo $request->input('name');
        //echo $request->input('sex', '性别未知');

        // 判断参数是否存在
//        if($request->has('name')) {
//            echo $request->input('name');
//        } else {
//            echo '无name参数';
//        }

        // 获取所有参数
//        $req = $request->all();
//        dd($req);

        /* 2、判断请求类型 */
        // 直接返回请求类型
//        echo $request->method();

        // 判断是否为某种请求类型，返回布尔值
//        if($request->isMethod('GET')) {
//            echo '这是GET请求';
//        } else {
//            echo '这不是GET请求';
//        }

        // 判断请求类型是否为ajax，返回布尔值
//        $isAjax = $request->ajax();
//        var_dump($isAjax);

        // 判断请求路径
//        $url = $request->is('student/*'); //请求路径中是否包含student
//        var_dump($url);

        // 获取url(不包含get传递参数)
        echo $request->url();
    }

    public function session1(Request $request) {
        /* 1、HTTP request session() */
        // 设置session
//        $request->session()->put('key1', 'val1');
        // 获取单个session
//        echo $request->session()->get('key1');

        /* 2、session辅助函数 */
//        session()->put('key2', 'val2');
//        echo session()->get('key2');

        /* 3、session facade */
        // 注意：需加上命名空间use Illuminate\Support\Facades\Session;
//        Session::put('key3', 'val3');
//        echo Session::get('key3');
        // 获取单个session，不存在则获取默认值
//        echo Session::get('key4', 'default');
        // 以数组的形式存设置session
//        Session::put(['key4' => 'val4']);
        // 把数据存储到session的数组中
//        Session::push('student', 'jane');
//        Session::push('student', 'imooc');

        // 数据暂存：只有第一次访问存在
        Session::flash('key-flash', 'val-flash');
    }
    public function session2(Request $request) {
        // 从session中获取数据然后删除
//        $sess = Session::pull('student', 'default');
//        var_dump($sess);

        // 获取session中所有数据
//        $all = Session::all();
//        dd($all);

        // 判断某个session是否存在
//        if(Session::has('key6')) {
//            echo Session::get('key6');
//        } else {
//            echo 'key6 not exist';
//        }

//        echo 'before forget:' . Session::get('key1') . '<br>';
        // 删除单个session
//        Session::forget('key1');
//        echo 'after forget:' . Session::get('key1');

        // 删除所有session
//        Session::flush();
//        dd(Session::all());

//
        echo Session::get('message', '暂无快闪数据');
    }

    public function response() {
//        $data = [
//            'errCode'   =>  0,
//            'errMsg'    =>  'success',
//            'errData'   =>  'student'
//        ];
        //var_dump($data);
        /* 1、响应类型为json */
//        return response()->json($data);

        /* 2、响应类型为重定向 */
//        return redirect('session2'); //跳转到session2页面

        // 重定向携带参数使用with，with原理为session的flush
//        return redirect('session2')->with('message', '我是快闪数据');
//        return redirect()->action('StudentController@session2')
//            ->with('message', '我是快闪数据'); //与上一语句效果相同

        // 通过route的别名来进行跳转
//        return redirect()->route('session2')
//            ->with('message', '我是快闪数据');

        // 返回上一个页面
        return redirect()->back();
    }

    public function activity0() {
        return '活动即将开始，敬请期待！';
    }
    public function activity1() {
        return '活动正在进行中，玩得愉快1';
    }
    public function activity2() {
        return '活动正在进行中，玩得愉快2';
    }
}