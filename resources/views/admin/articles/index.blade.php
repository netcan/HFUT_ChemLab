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
                                <strong>操作失败：</strong> <br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                        <a href="{{ url('article/create') }}" class="btn btn-block btn-success btn-lg">添加文章</a>
                            <br>
                            <a href="?filter=all" class="btn btn-info">显示全部 <span class="badge">{{ $articles_count }}</span></a>
                            <a href="?filter" class="btn btn-info">显示我的 <span class="badge">{{ $myArticles_count }}</span></a>
                            <a href="{{ url('admin/resources/categories') }}" class="btn btn-info">分类管理 <span class="badge"> {{ $categories_count }} </span></a>

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
                                    <td class="text-center"><a href="{{ url('/article/'.$article->id) }}">{{ $article->title }}</a></td>
                                    <td class="text-center">{{ $article->user->name }}</td>
                                    <td class="text-center">{{ $article->category->name }}</td>
                                    <td class="text-center">{{ $article->created_at }}</td>
                                    @can('opArticle', $article)
                                    <td class="text-center"><a class="btn btn-primary" href="{{ url('/article/'.$article->id.'/edit') }}">编辑</a></td>
                                    <td class="text-center">
                                        <form class="delete" action="{{ url('/article/'.$article->id) }}" method="POST" style="display: inline;">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <input type="submit" class="btn btn-danger" value="删除"/>
                                        </form>
                                    </td>
                                    @else
                                        <td class="text-center"><button class="btn"  disabled="disabled">编辑</button></td>
                                        <td class="text-center"><button class="btn"  disabled="disabled">删除</button></td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            {{ $articles->appends([
                                'filter'=> Request::get('filter'),
                                'cid' => Request::get('cid')
                            ])->links() }}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection