@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/resources') }}">资料库管理</a> > <a href="{{ url('admin/resources/categories') }}">分类管理</a> > 编辑分类
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>编辑失败</strong> 输入不符合要求<br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif

                        <form action="{{ url('admin/resources/categories/'.$category->id) }}" method="POST">
                            {!! csrf_field() !!}
                            {{ method_field('PUT') }}
                            <input type="text" name="name" class="form-control" required="required" placeholder="请输入分类名" value="{{ $category->name }}">
                            <br>
                            <button class="btn btn-lg btn-info">编辑分类</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
