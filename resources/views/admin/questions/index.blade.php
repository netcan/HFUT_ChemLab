@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/resources') }}">资料库管理</a> > 题库管理
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>操作失败</strong><br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif

                        <a href="questions/create" class="btn btn-block btn-success btn-lg">添加题目</a>
                            <br>
                            <a href="?filter=all" class="btn btn-primary">显示全部 <span class="badge">{{ $questions_count['all'] }}</span></a>
                            <a href="?filter=multi" class="btn btn-info">单选题 <span class="badge">{{ $questions_count['multi'] }}</span></a>
                            <a href="?filter=judge" class="btn btn-info">判断题 <span class="badge">{{ $questions_count['judge'] }}</span></a>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>题型</th>
                                <th>题目</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                                <th>答案</th>
                                <th>动作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                                <tr id="question{{ $question['id'] }}">
                                    <td>{{ $question['type'] == 0?'单选':'判断' }}</td>
                                    <td>{!! $question['content'] !!}</td>
                                    <td>{!! $question['type'] == 0?$question['A']:'' !!}</td>
                                    <td>{!! $question['type'] == 0?$question['B']:'' !!}</td>
                                    <td>{!! $question['type'] == 0?$question['C']:'' !!}</td>
                                    <td>{!! $question['type'] == 0?$question['D']:'' !!}</td>
                                    <td>{{ \App\Http\Controllers\Admin\QuestionController::getAns($question['type'], $question['ans']) }}</td>
                                    <td><button class="btn btn-warning edit-question" value="{{ $question['id'] }}">修改</button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            {{--modal--}}
                            <div class="modal fade" id="questionModal" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="questions_action">修改题目</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="qtype" class="control-label col-sm-2">题型</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" id="qtype">
                                                            <option value="0">单选</option>
                                                            <option value="1">判断</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <form id="question">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="qcontent" class="control-label col-sm-2">题目</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="qcontent" name="qcontent" class="form-control" required="required" placeholder="请输入题目内容">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="qselection">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="qA" class="control-label col-sm-2">A.</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" id="qA" name="qA" class="form-control" required="required" placeholder="选项A">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="qB" class="control-label col-sm-2">B.</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" id="qB" name="qB" class="form-control" required="required" placeholder="选项B">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="qC" class="control-label col-sm-2">C.</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" id="qC" name="qC" class="form-control" required="required" placeholder="选项C">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="qD" class="control-label col-sm-2">D.</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" id="qD" name="qD" class="form-control" required="required" placeholder="选项D">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="qans" class="control-label col-sm-2">答案</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="qans"></select>
                                                        </div>
                                                    </div>
                                                </div>
                                                {!! csrf_field() !!}
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="qsave" value="update">更新</button>
                                            <input type="hidden" id="qid" name="qid" value="-1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--paginate--}}
                            <div class="text-center">
                                {{ $questions->appends([
                                    'filter' => Request::get('filter'),
                                ])
                                ->links() }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection