<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>轻松学会laravel-@yield('title')</title>
    <style>
        .header{
            width: 1000px;
            height: 150px;
            margin:0 auto;
            background: #f5f5f5;
            border: 1px solid #ddd;
        }
        .main{
            width: 1000px;
            height: 300px;
            margin: 0 auto;
            margin-top: 15px;
            clear: both;
            background: #f5f5f5;
        }
        .sidebar{
            float: left;
            width: 20%;
            height: inherit;
            border: 1px solid #ddd;
            background: #f5f5f5;
        }
        .content{
            float: right;
            width: 75%;
            height: inherit;
            border: 1px solid #ddd;
            background: #f5f5f5;
        }
        .footer{
            width: 1000px;
            height: 150px;
            margin:0 auto;
            margin-top: 15px;
            border: 1px solid #ddd;
            background: #f5f5f5;
        }
    </style>
</head>
<body>
<!--
    section:用来定义视图片段
    yield:用来展示某个section里的内容
 -->
<div class="header" >
    @section('header')
    头部
    @show
</div>
<div class="main">
    <div class="sidebar">
        @section('sidebar')
        侧边栏
        @show
    </div>
    <div class="content">
        @yield('content','主要发布区域')
    </div>
</div>
<div class="footer">
    @section('footer')
    尾部
    @show
</div>
</body>
</html>