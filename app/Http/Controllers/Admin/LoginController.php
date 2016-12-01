<?php

//namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;
use App\Http\Model\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
require 'resources/org/vcode/Code.class.php';
class LoginController extends CommonController
{
    //
    public function login()
    {
        if( $input = Input::all()){

            $getVcode = $this ->getVcode();
            if($getVcode != strtoupper($input['vcode'])){

                return back()->with('msg','验证码错误');
            }else{

                $info = Users::first();


                if(($info->user_name == $input['username']) && ($input['password']==Crypt::decrypt($info->password))){
                    session(['user_info'=>$info]);
                    return redirect('admin/index');
                }else{
                    return back()->with('msg','用户名或密码错误');
                }
            }
        }else{
            return view('admin.login');
        }

    }


    /**
     * 生成验证码
     * author liuzp111
     */
    public function vcode()
    {
        $vcode = new \Code();
        echo $vcode->make();
    }

    /**
     * 获取验证码
     * author liuzp111
     */
    public function getVcode()
    {
        $vcode = new \Code();
        return $vcode ->get();
    }

    /**
     * 加密
     * 生成的加密串不会超过255
     * author liuzp111
     */
    public function enCrypt()
    {
        $str = '123456';
        echo Crypt::encrypt($str);
    }

    /**
     * 解密
     * author liuzp111
     */
    public function deCrypt()
    {
        $str = 'eyJpdiI6IllrSk5YbEpDS25mdjVDMVFLZ1Yzc1E9PSIsInZhbHVlIjoiNlVnNVBkWHNXbUs3RDVGTGl4RmN4dz09IiwibWFjIjoiNjEwZjI5M2UzZjliZDRiZDljMmZmYjdmMGJkNTJjNTIzZjUyNTU4OWE1NzYzN2JmZTIzZTdmOTQ3Mzk3ZDgzOSJ9';
        echo Crypt::decrypt($str);//123456
    }
}
