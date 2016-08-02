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
                            @foreach($data['articles'] as $article)
                                <tr>
                                    <td class="text-center">{{ $article->title }}</td>
                                    <td class="text-center">{{ $article->user->name }}</td>
                                    <td class="text-center">{{ $article->category->name }}</td>
                                    <td class="text-center">{{ $article->created_at }}</td>
                                    <td class="text-center"><a class="btn btn-info" href="{{ url('admin/resources/article/'.$article->id.'/edit') }}">编辑</a></td>
                                    <td class="text-center">
                                        <form class="delete" action="{{ url('admin/resources/article/'.$article->id) }}" method="POST" style="display: inline;">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <input type="submit" class="btn btn-danger" value="删除"/>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            @if($data['allpage']>1)
                                <nav>
                                    <ul class="pagination">
                                        <li class="{{ $data['nowpage'] == 1?'disabled':' ' }}"><a href="{{ $data['nowpage'] == 1?'/#':($data['nowpage']-1) }}" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                                        @if($data['allpage']<=5)
                                            @for($i=1; $i<=$data['allpage']; ++$i)
                                               <li class="{{ $i==$data['nowpage'] ? 'active':' ' }}"><a href="{{  $i }}">{{ $i }} <span class="sr-only">(current)</span></a></li>
                                            @endfor
                                        @endif
                                        @if($data['allpage'] > 5)
                                            @if($data['nowpage'] < 3)
                                                @for($i=1; $i<=5; ++$i)
                                                    <li class="{{ $i==$data['nowpage'] ? 'active':' ' }}"><a href="{{  $i }}">{{ $i }} <span class="sr-only">(current)</span></a></li>
                                                @endfor
                                            @elseif($data['nowpage'] >=3 && $data['nowpage']<=$data['allpage']-2)
                                                @for($i=$data['nowpage']-2; $i<=$data['nowpage']+2; ++$i)
                                                    <li class="{{ $i==$data['nowpage'] ? 'active':' ' }}"><a href="{{  $i }}">{{ $i }} <span class="sr-only">(current)</span></a></li>
                                                @endfor
                                            @else
                                                @for($i=$data['nowpage']-4; $i<=$data['allpage']; ++$i)
                                                    <li class="{{ $i==$data['nowpage'] ? 'active':' ' }}"><a href="{{  $i }}">{{ $i }} <span class="sr-only">(current)</span></a></li>
                                                @endfor
                                            @endif
                                        @endif

                                        <li class="{{ $data['nowpage'] == $data['allpage']?'disabled':' ' }}"><a href="{{ $data['nowpage'] == $data['allpage']?'#':($data['nowpage']+1) }}" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection