@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        试卷浏览
                    </div>
                    <div class="panel-body">
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
                                <th>动作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($papers as $paper)
                                    <tr>
                                        <td>{{ $paper->title }}</td>
                                        <td>{{ $paper->questions->where('type', 0)->count() }} x {{ $paper->multi_score }} </td>
                                        <td>{{ $paper->questions->where('type', 1)->count() }} x {{ $paper->judge_score }} </td>
                                        <td>{{ $paper->full_score }}</td>
                                        <td>{{ $paper->time }}</td>
                                        <td>{{ $paper->start_time }}</td>
                                        <td>{{ $paper->end_time }}</td>
                                        <td>
                                            @can('manage')
                                                <a href="paper/{{ $paper->id }}" class="btn btn-info btn-raised">浏览试卷</a>
                                            @else
                                                @if(!auth()->user()->papers()->find($paper->id) || auth()->user()->papers()->find($paper->id)->pivot->score == -1)
                                                    <a href="paper/{{ $paper->id }}" class="btn btn-primary btn-raised">开始考试</a>
                                                @else
                                                    <a href="paper/{{ $paper->id }}" class="btn btn-info btn-raised">答题结果</a>
                                                @endif
                                            @endcan

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
