<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function  login()
    {
        session(['key'=>123]);

        return 'admin/login';
    }
    public function index()
    {
        //echo session('key');
        echo 'index';
    }
}
