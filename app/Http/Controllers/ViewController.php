<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use App\Http\Model\Users;
class ViewController extends Controller
{

   public function index()
   {
//       $name = "陈华";
//       $age = 26;
       $data = [
           'name' => "华仔",
           'age' => 26
       ];

//       $title = "laravel课程";
       $title = "<script>alert(1)</script>";
       return view('my_laravel',compact('data','title'));
//       return view('my_laravel')->with('name',$name)->with('age',$age);
   }
   public function view()
   {
       $score = 45;
       $data = [
           'score' => [
               50,79,90,43
           ],
       ];
       return view('view_learn',compact('data','score'));
   }

    public function article()
    {
        $db = DB::connection()->getPdo();
        //dd($db);
//        $uses_list = DB::table('users')->get();
        $uses_list = DB::table('users')->where('user_id',2)->get();
        dd($uses_list);
        return view('article');
    }
    public function layouts()
    {
        //echo config('database.connections.mysql.prefix');
        $db = DB::connection()->getPdo();
//        dd($db);
        $users = DB::table('users')->where('user_id',1)->get();
//        dd($users);
        $user = Users::find(1);
//        dd($users);
        $user->user_name = 'wangwu';
        $user->update();

        dd($user);
        return view('layouts');
    }
}
