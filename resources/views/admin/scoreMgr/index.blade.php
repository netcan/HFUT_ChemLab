@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        成绩管理
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>试卷名</th>
                                <th>考试人数</th>
                                <th>满分</th>
                                <th>平均分</th>
                                <th>动作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($papers as $paper)
                                    <tr>
                                        <td>{{ $paper->title }}</td>
                                        <td>{{ $paper->users()->count() }}</td>
                                        <td>{{ $paper->full_score }}</td>
                                        <td>{{ round($paper->users()->where('score', '<>', -1)->avg('score') * 100 / $paper->full_score, 1) }}%</td>
                                        <td>
                                            <a href="{{ url('admin/scoreMgr/'.$paper->id) }}" class="btn btn-primary">查看</a>
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
