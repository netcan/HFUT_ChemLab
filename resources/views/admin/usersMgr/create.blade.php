@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/usersMgr') }}">用户管理</a> > 添加用户
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>添加失败</strong> 输入不符合要求<br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                            <form action="{{ url('admin/usersMgr') }}" method="POST">
                                <div class="form-group">
                                    <label for="uid">学号</label>
                                    <input type="number" class="form-control" placeholder="学号" name="uid" id="uid" value="{{ old('uid') }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">用户名</label>
                                    <input type="text" class="form-control" placeholder="用户名" name="name" id="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="type">类型</label>
                                    <select class="form-control" name="type" id="type">
                                        <option value="0">管理员</option>
                                        <option value="1">教师</option>
                                        <option value="2">学生</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password">密码</label>
                                    <input type="password" class="form-control" placeholder="设置密码..." name="password" id="password" value="">
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">确认密码</label>
                                    <input type="password" class="form-control" placeholder="确认密码..." name="password_confirmation" id="password-confirm" value="">
                                </div>

                                <div class="text-right">
                                    {!! csrf_field() !!}
                                    <button class="btn btn-info btn-raised" type="submit">新建</button>
                                </div>
                            </form>
                        <script>
                            $("#type").val({{ old('type') }});
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
