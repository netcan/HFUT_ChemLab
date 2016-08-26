@extends('layouts.app')

@section('content')
    <div class="container">
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
                            <div class="progress">
                                <div  id="remainTime" class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0">
                                </div>
                            </div>
                        @endcannot

                            @can('manage')
                                <form class="form-inline exam">
                            @else
                                <form class="form-inline exam" action="{{ $paper->id }}/submit" method="POST">
                            @endcan

                            <strong>一、判断题（每题 {{ $paper->judge_score }} 分，共 {{ $paper->questions()->where('type', 1)->count() * $paper->judge_score }} 分）</strong>
                            <ol>
                                @foreach($paper->questions()->where('type', 1)->get() as $question)
                                    <li>
                                        {{ $question->content }}
                                        （<select id='question{{ $question->id }}' name='question{{ $question->id }}' class="form-control">
                                            <option value="">请选择</option>
                                            <option value="0">正确</option>
                                            <option value="1">错误</option>
                                        </select>）
                                        @can('manage')
                                                <script>
                                                    $('#question{{ $question->id }}').val({{ $question->ans }})
                                                </script>
                                        @endcan
                                    </li>
                                @endforeach
                            </ol>
                            <strong>二、单选题（每题 {{ $paper->multi_score }} 分，共 {{ $paper->questions()->where('type', 0)->count() * $paper->multi_score }} 分）</strong>
                            <ol>
                                @foreach($paper->questions()->where('type', 0)->get() as $question)
                                    <li>
                                    {{ $question->content }}<br>
                                        @php
                                            $order = ['A', 'B', 'C', 'D'];
                                            $disorder = collect($order)->shuffle()->all();
                                            $selections = $question->getAttributes();
                                        @endphp

                                        @for($i=0; $i<4; ++$i)
                                        <input type="radio" name="question{{ $question->id }}" value="{{ array_search($disorder[$i], $order) }}"> {{ $order[$i] }}. {{ $selections[$disorder[$i]] }}<br>
                                        @endfor

                                        @can('manage')
                                            <script>
                                                $('input:radio[name=question{{ $question->id }}]').filter('[value={{ $question->ans }}]').prop('checked', true);
                                            </script>
                                        @endcan
                                    </li>
                                @endforeach
                            </ol>
                            @cannot('manage')
                                <div class="text-right">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">交卷</button>
                                </div>
                                <script>
                                    // exam
                                    function remainTime() {
                                        $.get('{{ $paper->id }}/remaintime', function (data) {
                                            $('#remainTime').css('width', data.percent);
                                            $('#remainTime').text('剩余时间：'+data.remainTime_Minute+'分钟');
                                        });
                                    }
                                    setInterval(remainTime, 1000);
                                </script>
                            @endcannot
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
