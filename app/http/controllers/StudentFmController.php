<?php
namespace App\Http\Controllers;

use App\StudentFm;
use Illuminate\Http\Request;
class StudentFmController extends Controller
{
    // 学生列表页
    public function index() {
        //$students = StudentFm::get();
        $students = StudentFm::paginate(3); //以分页形式获取数据
        return view('studentFm.index', [
            'students' =>  $students,
        ]);
    }

    // 新增学生
    public function create(Request $request) {
        $student = new StudentFm();

        if($request->ismethod('POST')) {
            /* 1、控制器验证 */
            /*$this->validate($request,[
                // 姓名规则：必须的，且最小为两个字符串
               'StudentInfo.name' =>  'required|min:2|max:20', //用"\"分割规则
                // 年龄规则：必须的，且必须为数字
               'StudentInfo.age' =>  'required|integer',
                // 性别规则：必须的，且必须为数字
               'StudentInfo.sex' =>  'required|integer',
                // web中间件中的ShareErrorsFromSession会自动抛出以上对应异常到view中
            ], [
                // 设置异常中规则的对应提示信息
                // :attribute为占位符
                'required'  =>  ':attribute为必填项',
                'min'       =>  ':attribute最小长度不符合要求',
                'max'       =>  ':attribute最大长度不符合要求',
                'integer'   =>  ':attribute必须为数字',
            ], [
                // 设置异常中字段的对应提示信息
                'StudentInfo.name'    =>  '姓名',
                'StudentInfo.age'     =>  '年龄',
                'StudentInfo.sex'     =>  '性别',
            ]);*/

            /* 2、validator验证 */
            // \Validator中的"\"表示全局
            $validator = \Validator::make($request->input(), [
                'StudentInfo.name' =>  'required|min:2|max:20',
                'StudentInfo.age' =>  'required|integer',
                'StudentInfo.sex' =>  'required|integer',
            ], [
                'required'  =>  ':attribute为必填项',
                'min'       =>  ':attribute最小长度不符合要求',
                'max'       =>  ':attribute最大长度不符合要求',
                'integer'   =>  ':attribute必须为数字',
            ], [
                'StudentInfo.name'    =>  '姓名',
                'StudentInfo.age'     =>  '年龄',
                'StudentInfo.sex'     =>  '性别',
            ]);
            if($validator->fails()) {
                return redirect()->back()
                    // 需要手动注册错误信息:withErrors
                    ->withErrors($validator)
                    // 数据保持(抛出异常后仍保留上次填写数据)
                    ->withInput();
            }

            $data = $request->input('StudentInfo');

            if(StudentFm::create($data)) {
                return redirect('StudentFm/index')->with('success', '添加成功!');
            } else {
                return redirect()->back();
            }
        }

        return view('studentFm.create', [
            'student' => $student
        ]);
    }

    // 保存学生信息
    public function save(Request $request) {
        $data = $request->input('StudentInfo');

        $studentSave = new StudentFm();
        $studentSave->name = $data['name'];
        $studentSave->age = $data['age'];
        $studentSave->sex = $data['sex'];

        if($studentSave->save()) {
            return redirect('StudentFm/index');
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request, $id) {
        $student = StudentFm::find($id);

        if($request->isMethod('POST')) {
            $this->validate($request,[
                'StudentInfo.name' =>  'required|min:2|max:20',
                'StudentInfo.age' =>  'required|integer',
                'StudentInfo.sex' =>  'required|integer',
            ], [
                'required'  =>  ':attribute为必填项',
                'min'       =>  ':attribute最小长度不符合要求',
                'max'       =>  ':attribute最大长度不符合要求',
                'integer'   =>  ':attribute必须为数字',
            ], [
                'StudentInfo.name'    =>  '姓名',
                'StudentInfo.age'     =>  '年龄',
                'StudentInfo.sex'     =>  '性别',
            ]);

            $data = $request->input('StudentInfo');
            $student->name = $data['name'];
            $student->age = $data['age'];
            $student->sex = $data['sex'];

            if($student->save()) {
                return redirect('StudentFm/index')->with('success', '修改成功');
            }
        }
        return view('studentFm.update', [
            'student'  =>  $student
        ]);
    }

    public function detail($id) {
        $student = StudentFm::find($id);
        return view('studentFm.detail', [
            'student'   =>  $student
        ]);
    }

    public function delete($id) {
        $student = StudentFm::find($id);

        if($student->delete()) {
            return redirect('StudentFm/index')->with('success', '删除成功');
        } else {
            return redirect('StudentFm/index')->with('error', '删除失败');
        }
    }
}