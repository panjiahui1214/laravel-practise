<!-- 所有的错误提示 -->
{{--web中间件中的ShareErrorsFromSession会自动抛出异常--}}
@if(count($errors))
    <div class="alert alert-danger">
        <ul>
            {{--抛出所有异常(英文)--}}
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

            {{--抛出第一个异常(英文)--}}
            {{--<li>{{ $errors->first() }}</li>--}}
        </ul>
    </div>
@endif