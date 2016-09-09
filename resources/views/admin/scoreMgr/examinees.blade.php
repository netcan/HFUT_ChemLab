@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/scoreMgr') }}">成绩管理（{{ $paper->title }}）</a> > 考生管理
                    </div>
                    <div class="panel-body">
                        <form action="updateScores/{{ $paper->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button type="submit" class="btn btn-warning">更新考生成绩</button>
                        </form>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>学号</th>
                                <th>考生名</th>
                                <th>考试时间</th>
                                <th>成绩/满分</th>
                                <th>百分比</th>
                                <th>动作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($examinees as $examinee)
                                <tr>
                                    <td>{{ $examinee->uid }}</td>
                                    <td>{{ $examinee->name }}</td>
                                    <td>{{ $examinee->pivot->start_time }}</td>
                                    @if($examinee->pivot->score == -1)
                                        <td>考试中/未交卷</td>
                                        <td>考试中/未交卷</td>
                                    @else
                                        <td>{{ $examinee->pivot->score }}/{{ $paper->full_score }}</td>
                                        <td>{{ round($examinee->pivot->score*100 / $paper->full_score, 1) }}%</td>
                                    @endif
                                    <td>
                                        <form class="reExam" action="{{ url('admin/scoreMgr/'.$paper->id.'/reExam/'.$examinee->id) }}" method="POST" style="display: inline;">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <input type="submit" class="btn btn-danger" value="重考"/>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right">
                            {{ $examinees->links() }}
                        </div>
                        <script>
                            $(".reExam").on("submit", function () {
                                return confirm("确定要重考？");
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
