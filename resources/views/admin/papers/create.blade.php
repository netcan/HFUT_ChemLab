@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/papers') }}">试卷管理</a> > 创建试卷
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>操作失败</strong><br><br>
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif

                        <form action="{{ url('/admin/papers/') }}" method="POST" class="form">
                            <div class="form-group">
                                <label for="name">试卷名</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="试卷名" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="multi_score">单选题分值</label>
                                <input type="number" step="0.1" name="multi_score" class="form-control" id="multi_score" placeholder="单选题分值" value="{{ old('multi_score') }}">
                            </div>
                            <div class="form-group">
                                <label for="judge_score">判断题分值</label>
                                <input type="number" step="0.1" name="judge_score" class="form-control" id="judge_score" placeholder="判断题分值" value="{{ old('judge_score') }}">
                            </div>
                            <div class="form-group">
                                <label for="time">考试时间(分钟)</label>
                                <input type="number" class="form-control" name="time" id="time" placeholder="考试时间" value="{{ old('time') }}">
                            </div>
                            <div class="form-group">
                                <label for="start_time">开始时间</label>
                                <input type="datetime-local" class="form-control" name="start_time" id="start_time" placeholder="开始时间" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
                            </div>
                            <div class="form-group">
                                <label for="end_time">结束时间</label>
                                <input type="datetime-local" class="form-control" name="end_time" id="end_time" placeholder="结束时间" value="{{ \Carbon\Carbon::create(2099,12,31,0,0)->format('Y-m-d\TH:i') }}">
                            </div>
                            <button type="submit" class="btn btn-success">提交</button>
                            {!! csrf_field() !!}
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
