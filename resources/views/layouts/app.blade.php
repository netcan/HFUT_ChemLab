<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>合肥工业大学化学实验室安全教育及在线考试系统</title>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-material-design.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ripples.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>

</head>
<body id="app-layout">
    <nav class="navbar navbar-danger navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                    <a class="" href="{{ url('/') }}">
                        <img src="img/hfut_logo.png" class="hfut_logo">
                        <img src="img/hfut.png" class="hfut">
                    </a>
                <img src="img/chemlab.png" class="chemlab">
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                {{--<ul class="nav navbar-nav">--}}
                    {{--<li><a href="{{ url('/home') }}">Home</a></li>--}}
                {{--</ul>--}}

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">登录</a></li>
                        {{--<li><a href="{{ url('/register') }}">Register</a></li>--}}
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('user/'.Auth::user()->id.'/changePwd') }}"><i class="fa fa-lock"></i> 修改密码</a></li>
                                @can('manage')
                                    <li><a href="{{ url('admin/questions') }}"><i class="fa fa-btn fa-pencil"></i>题库管理</a></li>
                                    <li><a href="{{ url('admin/papers') }}"><i class="fa fa-btn fa-newspaper-o"></i>试卷管理</a></li>
                                    <li><a href="{{ url('admin/scoreMgr') }}"><i class="fa fa-btn fa-percent"></i>成绩管理</a></li>
                                    @can('manageUser')
                                        <li><a href="{{ url('admin/usersMgr') }}"><i class="fa fa-btn fa-users"></i>用户管理</a></li>
                                    @endcan
                                    <li><a href="{{ url('/admin/resources') }}"><i class="fa fa-btn fa-book"></i>资料库管理</a></li>

                                    @can('manageUser')
                                        <li><a href="{{ url('admin/logs') }}"><i class="fa fa-btn fa-calendar"></i>查看日志</a></li>
                                        <li><a href="{{ url('admin/stats') }}" target="_blank"><i class="fa fa-btn fa-briefcase"></i>使用统计</a></li>
                                    @endcan
                                @endcan
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <!-- JavaScripts -->
    <script src="/js/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('js/app_config.js') }}"></script>
    <script src="{{ asset('js/material.min.js') }}"></script>
    <script src="{{ asset('js/ripples.min.js') }}"></script>
    <script>
        $.material.init();
    </script>

</body>
</html>
