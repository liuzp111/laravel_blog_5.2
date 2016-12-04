@extends('layouts.admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 添加文章
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
        <form action="{{url('admin/article')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>文章分类：</th>
                        <td>
                            <select name="cate_id">
<!--                                <option value="">==顶级分类==</option>-->
                                @foreach($data as $val)
                                    <option value="{{$val->cate_id}}">{{$val->_cate_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>文章标题：</th>
                        <td>
                            <input type="text" class="lg" name="article_title">
                            <!--                            <p>标题可以写30个字</p>-->
                        </td>
                    </tr>
                    <tr>
                        <th>编辑者（小编）：</th>
                        <td>
                            <input type="text" class="lg" name="article_editor">
                            <!--                            <p>标题可以写30个字</p>-->
                        </td>
                    </tr>
                    <tr>
                        <th>缩略图：</th>
                        <td>

                            <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                            <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
                            <input type="text" size="50" name="article_thumbnail">
                            <input id="file_upload" name="file_upload" type="file" multiple="true">
<!--                            <span><i class="fa fa-exclamation-circle yellow"></i>分类名称必须填写</span>-->

                            <script type="text/javascript">
                                <?php $timestamp = time();?>
                                $(function() {
                                    $('#file_upload').uploadify({
                                        'buttonText' : '点击上传缩略图',
                                        'formData'     : {
                                            'timestamp' : '<?php echo $timestamp;?>',
                                            '_token'     : '{{csrf_token()}}'
                                        },
                                        'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
                                        'uploader' : "{{url('admin/upload')}}",
                                        'onUploadSuccess' : function(file, data, response) {
                                            $('input[name=article_thumbnail]').val(data);
                                            $('#art_thumb_img').attr('src',"{{asset('uploads/')}}/"+data);
//                                    alert(data);
                                    }
                                });
                            });
                            </script>
                            <style>
                                .uploadify{display:inline-block;}
                                .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                                table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                            </style>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <img src="" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;">
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>关键词：</th>
                        <td>
                            <textarea name="article_keywords" class="lg"></textarea>
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
                            <textarea name="article_description"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>文章内容：</th>
                        <style>
                            .edui-default{line-height: 28px;}
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            {overflow: hidden; height:20px;}
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/UEditor/ueditor.config.js')}}"></script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/UEditor/ueditor.all.min.js')}}"> </script>
                        <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
                        <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/UEditor/lang/zh-cn/zh-cn.js')}}"></script>
                        <script id="editor" name="article_content" type="text/plain" style="width:1024px;height:500px;"></script>
                        <script type="text/javascript">

                            //实例化编辑器
                            //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                            var ue = UE.getEditor('editor');

                        </script>
<!--                        <th>文章内容：</th>-->
<!--                        <td>-->
<!--                            <textarea name="article_content"></textarea>-->
<!--                        </td>-->
                    </tr>
                    <tr>
                        <th>排序：</th>
                        <td>
                             <input type="text" class="sm"  name="sort_order">
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