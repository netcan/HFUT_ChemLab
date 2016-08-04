@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/resources') }}">资料库管理</a> > 分类管理
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>操作失败</strong><br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                        <a href="categories/create" class="btn btn-block btn-success btn-lg">添加分类</a>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>类别</th>
                                <th>编辑</th>
                                <th>删除</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td><a class="btn btn-primary" href="{{ url('/admin/resources/articles/?cid='.$category->id) }}">{{ $category->name }} <span class="badge">{{ $category->articles_count }}</span></a></td>
                                    <td><a class="btn btn-info" href="categories/{{ $category->id }}/edit">编辑</a></td>
                                    <td>
                                        @if($category->articles_count == 0)
                                            <form class="delete" action="categories/{{ $category->id }}" method="POST" style="display: inline;">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <input type="submit" class="btn btn-danger" value="删除"/>
                                            </form>
                                        @else
                                            <button disabled class="btn">删除</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection