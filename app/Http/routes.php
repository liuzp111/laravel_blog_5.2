<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//普通get路由
//http://127.0.0.1/laravel/public/basic1
//Route::get('basic1', function () {
//    return 'hello world';
//});
//普通post路由

//Route::post('basic1', function () {
//    return 'hello world';
//});
//多请求路由，接收post和get
//http://127.0.0.1/laravel/public/multy1
//Route::match(['get','post'],'multy1', function () {
//    return 'hello world multy1';
//});
//多请求路由
//http://127.0.0.1/laravel/public/multy2
//Route::any('multy2', function () {
//    return 'hello world multy2';
//});
//路由参数
//Route::get('user/{id}', function ($id) {
//    return 'user-'.$id;
//});
//路由参数
//Route::get('user/{name?}', function ($name=null) {
//    return 'user-name'.$name;
//});
//Route::get('user/{name?}', function ($name='default') {
//    return 'user-name'.$name;
//});
//Route::get('user/{name?}', function ($name) {
//    return 'user-name'.$name;
//})->where('name', '[A-Za-z]+');
//Route::get('user/{id}/{name}', function ($id,$name='default') {
//    return 'user-id-'.$id.'-name-'.$name;
//})->where(['id'=>'[0-9]+', 'name'=> '[A-Za-z]+']);

///路由别名
//Route::get('user/member-center',['as'=>'center',function(){
//    return route('center');
//}]);
//路由群组

//Route::group(['prefix'=>'member'],function(){
//    Route::get('user/member-center',['as'=>'center',function(){
//        return route('center');
//    }]);
//    Route::any('multy2', function () {
//        return 'hello world multy2';
//    });
//});
//http://127.0.0.1/laravel/public/member/info
//Route::get('member/info','MemberController@info');
//Route::get('member/info', ['uses'=>'MemberController@info']);
//Route::any('member/info', ['uses'=>'MemberController@info']);
//路由别名
//Route::any('member/info', [
//    'uses'=>'MemberController@info',
//    'as' => 'memberinfo'
//]);

//参数绑定
//http://127.0.0.1/laravel/public/member/1
//Route::any('member/{id}', [
//    'uses'=>'MemberController@info'
//])->where('id', '[0-9]+');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::group(['middleware' => ['web','admin.login']], function () {
//    Route::get('/', function () {
//        return view('welcome');
//    });
//});

//中间件web
//Route::group(['middleware'=>'web'],function(){
//    Route::get('admin/login','Admin\IndexController@login');
//    Route::get('/',function(){
//        session(['key'=>'456']);
//        return view('welcome');
//    });
//    Route::get('/test',function(){
//        echo  session('key');
//        return view('welcome');
//    });
//});
//前缀，命名空间，组。中间件
//Route::group(['prefix' =>'admin','namespace'=>'Admin','middleware'=>['web','admin.login']], function () {
//Route::group(['prefix'=>'admin','namespace'=>'Admin' ,'middleware'=>['web','admin.login']],function(){
//
//    Route::get('index','IndexController@index');
//});


//====视图
//Route::get('/view',function(){
//    return view('my_laravel');
//});
//Route::get('view','ViewController@index');
//Route::get('view_learn','ViewController@view');
//Route::get('article','ViewController@article');
//Route::get('layouts','ViewController@layouts');


//==========================================
//blog
//http://127.0.0.1/laravel/index.php/admin/login
//Route::any('admin/login','Admin\LoginController@login');//这里需要接受post传参，所以必须用混合路由，不用get,否则会报错
//Route::get('admin/vcode','Admin\LoginController@vcode');
//Route::get('admin/getVcode','Admin\LoginController@getVcode');
//Route::get('admin/enCrypt','Admin\LoginController@enCrypt');
//Route::get('admin/deCrypt','Admin\LoginController@deCrypt');

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });
    //路由要放中间件里面，否则会生成不了session,各种奇葩问题，卧槽
    Route::any('admin/crypt', 'Admin\LoginController@crypt');
    Route::any('admin/login','Admin\LoginController@login');//这里需要接受post传参，所以必须用混合路由，不用get,否则会报错
    Route::get('admin/vcode','Admin\LoginController@vcode');

});
//===设置中间件登陆验证，没有session跳转到login界面
Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function () {
    Route::any('index','IndexController@index');
    Route::any('info','IndexController@info');
    Route::any('quit','IndexController@quit');
    Route::any('pass','IndexController@pass');
    Route::resource('category', 'CategoryController');
    Route::resource('article', 'ArticleController');//php artisan route:list  查看路由列表
    Route::post('cate/changeSort','CategoryController@changeSort');
    Route::any('upload','CommonController@uploadFile');
//    Route::get('addCate','CategoryController@addCate');
});