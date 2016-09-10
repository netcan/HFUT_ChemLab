@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">资料库管理</div>
                <div class="panel-body">
                    <a href="{{ url('admin/resources/categories') }}" class="btn btn-lg btn-success col-xs-12 btn-block btn-raised">管理分类 <span class="badge">{{ $categories_count }}</span></a>
                    <a href="{{ url('admin/resources/articles') }}" class="btn btn-lg btn-success col-xs-12 btn-block btn-raised">管理文章 <span class="badge">{{ $articles_count }}</span></a>
                    <a href="{{ url('admin/resources/files') }}" class="btn btn-lg btn-success col-xs-12 btn-block btn-raised" target="_blank">文件管理</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection




