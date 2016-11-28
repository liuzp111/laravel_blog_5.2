<?php
/**
 * User: Administrator
 */

namespace App\Http\Controllers;

use App\Member;

class MemberController extends  Controller
{

    public function info($id)
    {
        //return 'memberinfo——'.$id;
//        return route('memberinfo');
//        return view('member/memberinfo');
//        return view('member/info',[
//            'name'=>'名字',
//            'age'=>90
//        ]);

        return Member::getMember();
    }

} 