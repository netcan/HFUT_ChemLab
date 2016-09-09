@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/resources') }}">资料库管理</a> > <a href="{{ url('admin/resources/categories') }}">分类管理</a> > 添加分类
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>添加失败</strong> 输入不符合要求<br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif

                        <form action="{{ url('admin/resources/categories') }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="text" name="name" class="form-control" required="required" placeholder="请输入分类名" value="{{ old('name') }}">
                            <br>
                            <div class="text-right">
                                <button class="btn btn-lg btn-info">添加分类</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
