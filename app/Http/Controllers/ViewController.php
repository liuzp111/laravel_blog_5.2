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

       $title = "laravel课程";
       return view('my_laravel',compact('data','title'));
//       return view('my_laravel')->with('name',$name)->with('age',$age);
   }
}
