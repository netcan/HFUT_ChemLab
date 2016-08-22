@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/papers') }}">试卷管理</a> > 编辑试卷
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>操作失败</strong><br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>题型</th>
                                    <th>题目</th>
                                    <th>添加/移除</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($questions as $question)
                                    <tr>
                                        <td>{{ \App\Http\Controllers\Admin\QuestionController::getType($question->type) }}</td>
                                        <td>{{ $question->content }}</td>
                                        <td>
                                            @if(in_array($question->id, $questions_added))
                                                <button class="btn btn-warning paper-question-action" value="{{ $question->id }}">移除</button>
                                            @else
                                                <button class="btn btn-info paper-question-action" value="{{ $question->id }}">添加</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                {!! csrf_field() !!}
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $questions->links() }}
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
