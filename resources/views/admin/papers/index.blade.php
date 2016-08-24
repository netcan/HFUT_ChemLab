@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        试卷管理
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>操作失败</strong><br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                        <a href="papers/create" class="btn btn-block btn-success btn-lg">添加试卷</a>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>试卷名</th>
                                <th>单选题分值</th>
                                <th>判断题分值</th>
                                <th>满分</th>
                                <th>考试时间（分钟）</th>
                                <th>开始时间</th>
                                <th>结束时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($papers as $paper)
                                <tr>
                                    <td><a href="{{ url('/paper/'.$paper->id) }}">{{ $paper->title }}</a></td>
                                    <td>{{ $paper->questions->where('type', 0)->count() }} x {{ $paper->multi_score }} </td>
                                    <td>{{ $paper->questions->where('type', 1)->count() }} x {{ $paper->judge_score }} </td>
                                    <td>{{ $paper->questions->where('type', 0)->count()*$paper->multi_score + $paper->questions->where('type', 1)->count()*$paper->judge_score }}</td>
                                    <td>{{ $paper->time }}</td>
                                    <td>{{ $paper->start_time }}</td>
                                    <td>{{ $paper->end_time }}</td>
                                    <td>
                                        <a href="papers/{{ $paper->id }}/edit" class="btn btn-info">编辑</a>

                                        <form class="delete" action="{{ url('/admin/papers/'.$paper->id) }}" method="POST" style="display: inline;">
                                            {!! csrf_field() !!}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" class="btn btn-danger" value="删除"/>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <div class="text-right">
                                {{ $papers->links() }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection