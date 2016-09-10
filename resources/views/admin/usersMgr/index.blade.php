@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        用户管理
                    </div>
                    <div class="panel-body">
                        <a href="{{ url('admin/usersMgr/create') }}" class="btn btn-block btn-success btn-lg btn-raised">添加用户</a>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>操作失败</strong><br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>学号</th>
                                <th>姓名</th>
                                <th>类型</th>
                                <th>动作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->uid }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ \App\User::getType($user->type) }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-raised" href="{{ url('admin/usersMgr/'.$user->id.'/edit') }}">编辑</a>
                                        <form class="delete" action="{{ url('/admin/usersMgr/'.$user->id) }}" method="POST" style="display: inline;">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <input type="submit" class="btn btn-danger btn-raised" value="删除"/>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
