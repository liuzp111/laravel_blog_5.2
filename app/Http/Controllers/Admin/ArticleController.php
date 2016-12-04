<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

/**
 *
|        | GET|HEAD                       | admin/article                  | admin.article.index    | App\Http\Controllers\Admin\ArticleController@index
|        | POST                           | admin/article                  | admin.article.store    | App\Http\Controllers\Admin\ArticleController@store
|        | GET|HEAD                       | admin/article/create           | admin.article.create   | App\Http\Controllers\Admin\ArticleController@create
|        | PUT|PATCH                      | admin/article/{article}        | admin.article.update   | App\Http\Controllers\Admin\ArticleController@update
|        | DELETE                         | admin/article/{article}        | admin.article.destroy  | App\Http\Controllers\Admin\ArticleController@destroy
|        | GET|HEAD                       | admin/article/{article}        | admin.article.show     | App\Http\Controllers\Admin\ArticleController@show
|        | GET|HEAD                       | admin/article/{article}/edit   | admin.article.edit     | App\Http\Controllers\Admin\ArticleController@edit
 * Class ArticleController
 * @package App\Http\Controllers\Admin
 * anthor:liuzp111
 */
class ArticleController extends CommonController
{
    //
    /**
     * GET admin/article
     * author liuzp111
     */
    public function index()
    {
        $data = Article::orderBy('article_id','desc')->paginate(3);//以3篇文章为一页，进行分页读取
        return view('admin.article.list',compact('data'));
    }

    /**
     *POST admin/article 添加文章提交
     * author liuzp111
     */
    public function store()
    {
        $input = Input::except('_token');
        $input['add_time'] = time();
        $rules = [
            'article_title'=>'required',
            'article_content' =>'required'
        ];
        $message = [
            'article_title.required'=>'文章标题不能为空',
            'article_content.required'=>'文章内容不能为空'
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            $res = Article::create($input);
            if($res){
                return redirect('admin/article');
            }else{
                return back()->withErrors($validator);
            }
        }
    }
    /**
     *GET admin/article/create
     * author liuzp111
     */
    public function create()
    {
        $data = (new Category())->tree();
        return view('admin.article.add',compact('data'));
    }
    /**
     *PUT admin/article/{article} 文章修改提交
     * author liuzp111
     */
    public function update($article_id)
    {
        $input = Input::except('_method','_token');
        $res = Article::where('article_id',$article_id)->update($input);
        if($res){
            return redirect('admin/article');
        }else{
            return back()->with('errors','文章更新失败，请稍后重试');
        }
    }
    /**
     *DELETE  admin/article/{article} 删除文章提交
     * author liuzp111
     */
    public function destroy($article_id)
    {
        $res = Article::where('article_id',$article_id)->delete();
        if($res){
            $data = [
                'status'=>'1',
                'msg' =>'文章删除成功'
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' =>'文章删除失败，请稍后重试'
            ];
        }
        return $data;
    }
    /**
     *GET  admin/article/{article}
     * author liuzp111
     */
    public function show()
    {

    }
    /**
     *GET  admin/article/{article}/edit  文章修改
     * author liuzp111
     */
    public function edit($article_id)
    {
        $data = (new Category)->tree();
        $info = Article::find($article_id);
        return view('admin/article/edit',compact('data','info'));
    }
}
