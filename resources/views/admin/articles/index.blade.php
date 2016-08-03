@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/resources') }}">资料库管理</a> > 文章管理
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>删除失败：</strong> <br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                        <a href="categories/create" class="btn btn-block btn-success btn-lg">添加文章</a>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">标题</th>
                                <th class="text-center">作者</th>
                                <th class="text-center">类别</th>
                                <th class="text-center">创建时间</th>
                                <th class="text-center">编辑</th>
                                <th class="text-center">删除</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td class="text-center">{{ $article->title }}</td>
                                    <td class="text-center">{{ $article->user->name }}</td>
                                    <td class="text-center">{{ $article->category->name }}</td>
                                    <td class="text-center">{{ $article->created_at }}</td>
                                    <td class="text-center"><a class="btn btn-info" href="{{ url('/article/'.$article->id.'/edit') }}">编辑</a></td>
                                    <td class="text-center">
                                        <form class="delete" action="{{ url('/article/'.$article->id) }}" method="POST" style="display: inline;">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <input type="submit" class="btn btn-danger" value="删除"/>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            {{ $articles->links() }}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection