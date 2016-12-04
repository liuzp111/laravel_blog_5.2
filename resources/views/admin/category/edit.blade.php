@extends('layouts.admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 编辑文章分类
<!--        <a href="#">商品管理</a> &raquo;-->
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
<!--            <h3>快捷操作</h3>-->
            @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
            @endif
        </div>
<!--        <div class="result_content">-->
<!--            <div class="short_wrap">-->
<!--                <a href="#"><i class="fa fa-plus"></i>新增文章</a>-->
<!--                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>-->
<!--                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/category/'.$cate_info->cate_id.' ')}}" method="post">
            <!--声明使用put方法-->
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>父级分类：</th>
                        <td>
                            <select name="cate_pid">
                                <option value="">==顶级分类==</option>
                                @foreach($data as $val)
                                    <option value="{{$val->cate_id}}" @if($val->cate_id == $cate_info->cate_pid) selected="selected" @endif>
                                        {{$val->cate_name}}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>分类名称：</th>
                        <td>
                            <input type="text" name="cate_name" value="{{$cate_info->cate_name}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>分类名称必须填写</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>分类标题：</th>
                        <td>
                            <input type="text" class="lg" name="cate_title" value="{{$cate_info->cate_title}}">
<!--                            <p>标题可以写30个字</p>-->
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>关键词：</th>
                        <td>
                            <textarea name="cate_keywords">{{$cate_info->cate_keywords}}</textarea>
<!--                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>-->
                        </td>
                    </tr>
<!--                    <tr>-->
<!--                        <th><i class="require">*</i>描述：</th>-->
<!--                        <td><input type="text" name=""></td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <th>单选框：</th>-->
<!--                        <td>-->
<!--                            <label for=""><input type="radio" name="">单选按钮一</label>-->
<!--                            <label for=""><input type="radio" name="">单选按钮二</label>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <th>复选框：</th>-->
<!--                        <td>-->
<!--                            <label for=""><input type="checkbox" name="">复选框一</label>-->
<!--                            <label for=""><input type="checkbox" name="">复选框二</label>-->
<!--                        </td>-->
<!--                    </tr>-->
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="cate_description">{{$cate_info->cate_description}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>排序：</th>
                        <td>
                             <input type="text" class="sm"  name="cate_order" value="{{$cate_info->cate_order}}">
                        </td>
<!--                            <p>标题可以写30个字</p>-->
                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection