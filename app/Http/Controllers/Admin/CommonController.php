<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //图片上传处理
    public function uploadFile()
    {
        $input = Input::file('Filedata');//处理文件的函数
        if($input->isValid())
        {
            $extension = $input->getClientOriginalExtension();//获取上传文件的后缀，jpg\gif...
            $newName= date('YmdHis').mt_rand(100,999).'.'.$extension;//重命名上传的文件
            $path = $input->move(base_path().'/uploads',$newName);//将上传的文件移到到uploads下
            $filepath = $newName;
            return $filepath;
        }

    }
}
