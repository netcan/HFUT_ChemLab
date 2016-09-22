@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @can('manage')
                            试卷浏览：
                        @else
                            正在考试：
                        @endcan
                        {{ $paper->title }}
                    </div>
                    <div class="panel-body">
                        @cannot('manage')
                            @if($user_paper->pivot->score == -1)
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="progress">
                                                <div id="remainProgBar" class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="alert alert-success">
                                                <strong>剩余时间</strong>
                                                <br>
                                                <span id="remainTime"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-success" role="alert">
                                    考试结束，您的成绩为<strong>{{ $user_paper->pivot->score }}</strong>，试卷满分为<strong>{{ $paper->full_score }}</strong>，百分比<strong>{{ round($user_paper->pivot->score * 100 / $paper->full_score, 1) }}%</strong>。
                                </div>
                            @endif
                        @endcannot

                            @can('manage')
                                <form class="form-inline exam">
                            @else
                                @if($user_paper->pivot->score == -1)
                                    <form id="exam" class="form-inline exam" action="{{ $paper->id }}/submit" method="POST">
                                @else
                                    <form class="form-inline exam">
                                @endif
                            @endcan

                            <strong>一、判断题（每题 {{ $paper->judge_score }} 分，共 {{ $paper->questions()->where('type', 1)->count() * $paper->judge_score }} 分）</strong>
                            <ol>
                                @foreach($paper->questions()->where('type', 1)->get() as $question)
                                    <li>
                                        {{ $question->content }}
                                        （<div class="form-group question-selection">
                                        <select id='question{{ $question->id }}' name='question{{ $question->id }}' class="form-control">
                                            <option value="">请选择</option>
                                            <option value="0">&nbsp;正确&nbsp;</option>
                                            <option value="1">&nbsp;错误&nbsp;</option>
                                        </select>
                                        </div>）
                                        @can('manage')
                                                <script>
                                                    $('#question{{ $question->id }}').val({{ $question->ans }})
                                                    $('#question{{ $question->id }}').attr('disabled', 'disabled');
                                                </script>
                                        @else
                                            @if($user_paper->pivot->score != -1)
                                                @php
                                                    $yourAns = $user->questions()->wherePivot('pid', $paper->id)->find($question->id)->pivot->ans;
                                                    $ans = $question->ans;
                                                    if($yourAns == -1) $yourAns = null;
                                                @endphp
                                                @if(isset($yourAns) && $yourAns == $ans)
                                                    <p class="text-success">您的答案正确</p>
                                                @else
                                                    <p class="text-danger">您的答案错误</p>
                                                @endif
                                                <script>
                                                    $('#question{{ $question->id }}').val({{ $yourAns }})
                                                    $('#question{{ $question->id }}').attr('disabled', 'disabled');
                                                </script>
                                            @endif
                                        @endcan
                                    </li>
                                @endforeach
                            </ol>
                            <strong>二、单选题（每题 {{ $paper->multi_score }} 分，共 {{ $paper->questions()->where('type', 0)->count() * $paper->multi_score }} 分）</strong>
                            <ol>
                                @foreach($paper->questions()->where('type', 0)->get() as $question)
                                    <li>
                                    <p>{{ $question->content }}</p>
                                        @php
                                            $order = ['A', 'B', 'C', 'D'];
                                        //    $disorder = collect($order)->shuffle()->all();
                                            $disorder = collect($order)->all();
                                            $selections = $question->getAttributes();
                                        @endphp

                                        @for($i=0; $i<4; ++$i)
                                                <label class="radio radio-inline question-multi">
                                                    <input type="radio" name="question{{ $question->id }}" value="{{ array_search($disorder[$i], $order) }}"> {{ $order[$i] }}. {{ $selections[$disorder[$i]] }}
                                                </label>
                                            <br>
                                        @endfor

                                        @can('manage')
                                            <script>
                                                $('input:radio[name=question{{ $question->id }}]').attr('disabled', 'disabled');
                                                $('input:radio[name=question{{ $question->id }}]').filter('[value={{ $question->ans }}]').prop('checked', true);
                                                $('input:radio[name=question{{ $question->id }}]').filter('[value={{ $question->ans }}]').prop('disabled', false);
                                            </script>
                                        @else
                                            @if($user_paper->pivot->score != -1)
                                                @php
                                                    $yourAns = $user->questions()->wherePivot('pid', $paper->id)->find($question->id)->pivot->ans;
                                                    $ans = $question->ans;
                                                    $ansText = $selections[$order[$ans]];
                                                    if($yourAns == -1) $yourAns = null;
                                                @endphp
                                                @if(isset($yourAns) && $yourAns == $ans)
                                                    <p class="text-success">您的答案正确</p>
                                                @else
                                                    <p class="text-danger">您的答案错误，正确答案是：`{{ $ansText }}`</p>
                                                @endif

                                                <script>
                                                    $('input:radio[name=question{{ $question->id }}]').attr('disabled', 'disabled');
                                                    $('input:radio[name=question{{ $question->id }}]').filter('[value={{ $yourAns }}]').prop('checked', true);
                                                    $('input:radio[name=question{{ $question->id }}]').filter('[value={{ $yourAns }}]').prop('disabled', false);
                                                </script>
                                            @endif
                                        @endcan
                                    </li>
                                @endforeach
                            </ol>
                            @cannot('manage')
                                @if($user_paper->pivot->score == -1)
                                    <div class="text-right">
                                        {{ csrf_field() }}
                                        <button id="examSubmit" type="submit" class="btn btn-primary btn-raised">交卷</button>
                                    </div>
                                    <script>
                                        // exam
                                        tip = true;
                                        submitted = false;
                                        function remainTime() {
                                            $.get('{{ $paper->id }}/remaintime', function (data) {
                                                if(tip && data.remainTime <= 60) {
                                                    toastr.info('您的考试时间不足一分钟，请抓紧时间交卷，否将自动交卷！');
                                                    tip = false;
                                                }
                                                if(data.remainTime < 5 && !submitted) {
                                                    $('#exam').submit();
                                                    submitted = true;
                                                }

                                                $('#remainProgBar').css('width', data.percent);
                                                $('#remainTime').text('剩余时间：'+data.remainTime_Minute+'分钟');
                                            });
                                        }
                                        setInterval(remainTime, 1000);

                                        $('#examSubmit').on("click", function () {
                                            return confirm('你确定要交卷？');
                                        });
                                    </script>
                                @endif
                                <script>
                                    $(document).ready(function() {
                                        $('body').bind('copy cut paste', function(e) {
                                            e.preventDefault();
                                            toastr.warning('禁止复制！');
                                        });
                                    });
                                </script>
                            @endcannot
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
