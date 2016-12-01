<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    //

    public function index()
    {
        //echo session('key');
        return view('admin.index');
    }

    /**
     * 首页信息展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * author liuzp111
     */
    public function info()
    {
        //echo session('key');
        return view('admin.info');
    }

    /**
     * 退出登陆
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * author liuzp111
     */
    public function quit()
    {
        session(['user_info'=>null]);
        return redirect('admin/login');
    }

    /**
     * 修改密码
     * author liuzp111
     */
    public function pass()
    {
        if($input = Input::all()){
            $rules = [
                'password'=>'required|between:6,20|confirmed' ,
                'password_confirmation' => 'required|min:6'
            ];
            $message = [
                'password.required' =>'新密码不能为空！',
                'password.between' =>'新密码必须在6-20位之间！',
                'password.confirmed' =>'新密码和确认密码不一致！',
                'password_confirmation.required' => '确认密码不能为空'
            ];
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $user = Users::first();
                $_password = Crypt::decrypt($user ->password);
                if($input['password_o'] == $_password){
                    $user-> password = Crypt::encrypt($input['password']);
                    $user->update();
                    return redirect('admin/info');
                }else{
                    return back() ->with('errors','原密码错误！');
                }

            }else{
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.pass');
        }

    }
}
