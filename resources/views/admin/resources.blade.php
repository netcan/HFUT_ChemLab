@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">资料库管理</div>
                <div class="panel-body">
                    <a href="{{ url('admin/resources/categories') }}" class="btn btn-lg btn-success col-xs-12 btn-block">管理分类</a>
                    <a href="{{ url('admin/resources/articles/page/1') }}" class="btn btn-lg btn-success col-xs-12 btn-block">管理文章</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection




