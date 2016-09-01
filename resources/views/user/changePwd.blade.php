@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/usersMgr') }}">用户管理</a> > 编辑用户信息
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>修改失败</strong> <br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                        <form action="{{ url('user/'.$user->id.'/changePwd') }}" method="POST">
                            <div class="form-group">
                                <label for="password">密码</label>
                                <input type="password" class="form-control" placeholder="需要重置密码请填写密码..." name="password" id="password" value="{{ old('password') }}">
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">确认密码</label>
                                <input type="password" class="form-control" placeholder="需要重置密码请填写密码..." name="password_confirmation" id="password-confirm" value="{{ old('password') }}">
                            </div>

                            <div class="text-right">
                                {!! csrf_field() !!}
                                {{ method_field('PUT') }}
                                <button class="btn btn-info" type="submit">提交</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
