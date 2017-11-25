<form class="form-horizontal" method="post" action="">
    {{--laravel默认开启了csrf验证，post请求需要验证csrf，所以要在表单里加这个隐藏域--}}
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">姓名</label>

        <div class="col-sm-5">
            <input type="text" name="StudentInfo[name]" class="form-control"
                   {{--获取上次填写数据:old()--}}
                   value="{{ old('StudentInfo')['name'] ?  old('StudentInfo')['name'] : (isset($student->name) ? $student->name : '') }}"
                   id="name" placeholder="请输入学生姓名">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('StudentInfo.name') }}</p>
        </div>
    </div>
    <div class="form-group">
        <label for="age" class="col-sm-2 control-label">年龄</label>

        <div class="col-sm-5">
            <input type="text" name="StudentInfo[age]" class="form-control"
                   {{--获取上次填写数据:old()--}}
                   value="{{ old('StudentInfo')['age'] ? old('StudentInfo')['age'] : (isset($student->age) ? $student->age : '') }}"
                   id="age" placeholder="请输入学生年龄">
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('StudentInfo.age') }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">性别</label>

        <div class="col-sm-5">
            @foreach($student->getSex() as $ind=>$val)
                <label class="radio-inline">
                    <input type="radio" name="StudentInfo[sex]"
                           {{ (isset($student->sex) && $student->sex == $ind) ? 'checked' : '' }}
                           value="{{ $ind }}"> {{ $val }}
                </label>
            @endforeach
        </div>
        <div class="col-sm-5">
            <p class="form-control-static text-danger">{{ $errors->first('StudentInfo.sex') }}</p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </div>
</form>