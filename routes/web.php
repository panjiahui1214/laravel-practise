<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* 基础路由 */
// 使用get方式访问
Route::get('basic', function() {
   return 'hello laravel';
});
// 使用post方式访问
Route::post('basic2', function() {
    return 'hello laravel';
});

/* 多请求路由 */
// 可使用get/post方式访问
Route::match(['get','post'], 'myfirst', function() {
    return 'my first';
});
// 可使用所有方式访问
Route::any('all', function() {
    return 'all';
});

/* 路由参数 */
//Route::get('user/{id}', function($id) {
//    return 'user-id-' . $id;
//})->where('id', '[0-9]+');
//Route::get('user/{name?}', function($name = 'jane') {
//    return 'user-name-' . $name;
//})->where('name', '[a-zA-Z]+');
Route::get('user/{id}/{name}', function($id, $name) {
    return "user-id-" . $id . "-name-" . $name;
})->where(['id' => '[0-9]+', 'name' => '[a-zA-z]+']);

/* 路由命名 */
//Route::get('user/member-center', ['as' => 'center', function() {
//    return route('center');
//}]);

/* 路由群组 */
// 群组中的路由访问url路径需加上群组名
Route::group(['prefix' => 'member'], function() {
    Route::get('user/member-center', ['as' => 'center', function() {
        return route('center');
    }]);
    Route::any('all', function() {
        return 'all';
    });
});

/* 路由中输出视图 */
Route::get('view', function () {
    return view('welcome');
});

/* 调用MemberController控制器中的info方法 */
//Route::get('member/info', 'MemberController@info');
//Route::get('member/info', ['uses' => 'MemberController@info']);
Route::get('member/{id}', 'MemberController@info')->where('id', '[0-9]+');

Route::any('test1', 'StudentController@test1');
Route::any('query1', 'StudentController@query1');
Route::any('query2', 'StudentController@query2');
Route::any('query3', 'StudentController@query3');
Route::any('query4', 'StudentController@query4');
Route::any('query5', 'StudentController@query5');
Route::any('orm1', 'StudentController@orm1');
Route::any('orm2', 'StudentController@orm2');
Route::any('orm3', 'StudentController@orm3');
Route::any('orm4', 'StudentController@orm4');
Route::any('section1', 'StudentController@section1');
Route::any('url', ['as' => 'url', 'uses' => 'StudentController@urlTest']);
//Route::any('url', 'StudentController@urlTest');//此种方法未设置别名，view中不能使用route()

/**
 * artisan创建命令：php artisan make:auth
 * artisan create begin
 **/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/**
 * artisan create end
 **/
Route::any('upload', 'StudentsController@upload');
Route::any('mail', 'StudentsController@mail');
Route::any('cache1', 'StudentsController@cache1');
Route::any('cache2', 'StudentsController@cache2');
Route::any('error', 'StudentsController@error');
Route::any('queue', 'StudentsController@queue');

Route::any('student/request1', 'StudentController@request1');
Route::group(['middleware' => 'web'], function() {
    // 使用中间件web（app/http/Kemel.php），其中已包含session_start()
    Route::any('session1', 'StudentController@session1');
    Route::any('session2', [
        'as'    =>  'session2',
        'uses'  =>  'StudentController@session2'
    ]);
});
Route::any('response', 'StudentController@response');

// 宣传页面
Route::any('activity0', 'StudentController@activity0');
// 活动页面
Route::group(['middleware' => 'activity'], function() {
    Route::any('activity1', 'StudentController@activity1');
    Route::any('activity2', 'StudentController@activity2');
});

Route::group(['middleware' => 'web'], function() {
    Route::get('StudentFm/index', 'StudentFmController@index');
    Route::any('StudentFm/create', 'StudentFmController@create');
    Route::any('StudentFm/save', 'StudentFmController@save');
    Route::any('StudentFm/update/{id}', 'StudentFmController@update');
    Route::any('StudentFm/detail/{id}', 'StudentFmController@detail');
    Route::any('StudentFm/delete/{id}', 'StudentFmController@delete');
});