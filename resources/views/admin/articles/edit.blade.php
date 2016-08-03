@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/resources') }}">资料库管理</a> > <a href="{{ url('admin/resources/articles/') }} ">文章管理</a> > 编辑文章
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>编辑失败</strong> 输入不符合要求<br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                            <form action="{{ url('article/'.$data['article']->id) }}" method="POST" novalidate>
                                {{ method_field('PUT') }}
                                {!! csrf_field() !!}
                                <input type="text" name="title" class="form-control" required="required" placeholder="请输入标题" value="{{  $data['article']->title }}">
                                <br>
                                <textarea name="content" rows="10" class="form-control" required="required" placeholder="请输入内容">{!! $data['article']->content !!}</textarea>
                                <br>
                                <div class="text-right">
                                    <select class="form-control" name="category">
                                        <option value="">请选择分类</option>
                                        @foreach($data['categories'] as $category)
                                            <option value="{{ $category->id }}" {{ $data['article']->cid == $category->id?'selected':'' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-info" type="submit">更新</button>
                                </div>
                            </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
