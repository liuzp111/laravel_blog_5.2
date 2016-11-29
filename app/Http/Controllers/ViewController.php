<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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
        return view('article');
    }
    public function layouts()
    {
        return view('layouts');
    }
}
