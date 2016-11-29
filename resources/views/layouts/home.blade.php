
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        .header{height:100px;background: darkred}
        .middle{height: 300px; background: lightblue}
        .footer{height:100px;background: yellowgreen}
    </style>
</head>
<body>
<div class="header">我是公共头部</div>
{{--@yield('content')--}}

@section('content')
<P>我是主模板里的内容</P>
@show

<div class="footer">我是公共底部</div></body>
</html>