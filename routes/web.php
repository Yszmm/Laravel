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

use App\User;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    $user  = \Illuminate\Support\Facades\Auth::user();  // 获取当前已通过认证的用户
    //$user = DB::table('users')->where('id',1)->first();
    //$user = User::all()->first();   //查询一条数据

    return view('welcome',['user'=>$user]);
    //return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/article/store','ArticleController@store');

Route::any('/articlelist',function() {

//    if (!isset($_SESSION['user']))
//    {
//        return view('admin.articlelist');
//    }
//    else{
//        return redirect('/login/l');
//    }

    return view('admin.articlelist');
})->middleware('auth');
Route::any('articleadd',function (){
    return view('admin.articleadd');
})->middleware('auth');
Route::any('/article/{id}',function ($id){
   return view('admin.article',['id'=>$id]);
});
Route::any('/article_list/{id}',function ($type_id){
   return view('admin.article_list',['type_id'=>$type_id]);
});
Route::any('/updata/{id}','ArticleController@updata');

Route::any('articleedit/{id}','ArticleController@edit')->middleware('auth');

Route::get('articledel/{id}','ArticleController@del');

Route::any('/loginclick/s','ArticleController@click');

Route::get('/login/l','ArticleController@loginl');

Route::get('/welcome',function (){
   return view('admin.index');
});

//第三方登陆

Route::get('handleProviderCallback/{service}', 'OAuthController@handleProviderCallback');//获取用户资料并登陆

Route::get('redirectToProvider/{service}', 'OAuthController@redirectToProvider');  //登陆重定向

Route::get('logout', 'OAuthController@logout');// 退出登录