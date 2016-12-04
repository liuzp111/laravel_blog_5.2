<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //
    /**
     *  GET|HEAD admin/category
     * author liuzp111
     */
    public function index()
    {
        $category_list = (new Category())->tree();
        return view('admin.category.index')->with('data',$category_list);
    }

    /**
     * 分类添加提交
     * POST admin/category
     * author liuzp111
     */
    public function store()
    {
        $input = Input::except('_token');//将_token排除在外，其他数据用于插入
        $rules = [
            'cate_name'=>'required'
        ];
        $message = [
            'cate_name.required'=>'分类名称不能为空'
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            $res = Category::create($input);
            if($res){
                return redirect('admin/category');
            }else{
                return back()->with('errors','分类添加失败，请稍后重试');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    /**
     * GET admin/category/create
     * author liuzp111
     */
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();

        return view('admin.category.add',compact('data'));
    }

    /**
     * 删除分类
     *  DELETE    admin/category/{category}
     * author liuzp111
     */
    public function destroy($cate_id)
    {
        $res = Category::where('cate_id',$cate_id) -> delete();
        //$cate_pid = Category::where('cate_id',$cate_id)->get();//print_r($cate_pid);die;
        //if($cate_pid->cate_pid == 0){
            Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
       // }
        if($res){
            $data = [
                'status'=>1,
                'msg'=>'分类删除成功'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'分类删除失败'
            ];
        }
        return $data;
    }
    /**
     *  GET|HEAD     admin/category/{category}
     * author liuzp111
     */
    public function show()
    {

    }
    /**
     * 分类修改
     *  GET|HEAD     admin/category/{category}/edit
     * author liuzp111
     */
    public function edit($cate_id)
    {
        $data = Category::where('cate_pid',0)->get();
        $cate_info = Category::find($cate_id);
        return view('admin.category.edit',compact('data','cate_info'));
    }
    /**
     * 分类修改提交，更新数据
     *  PUT|PATCH   admin/category/{category}
     * author liuzp111
     */
    public function update($cate_id)
    {
        $input = Input::except('_method','_token');
        $res = Category::where('cate_id',$cate_id) ->update($input);
        if($res){
            return redirect('admin/category');
        }else{
            return back()->with('errors','分类信息更改失败');
        }
    }
    public function changeSort()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $res = $cate -> update();
        if($res){
            $data = [
                'status' => 1,
                'msg'=> '分类排序更新成功'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg' => '分类排序更新失败'
            ];
        }
        return $data;
    }
    public function addCate()
    {

    }
}
