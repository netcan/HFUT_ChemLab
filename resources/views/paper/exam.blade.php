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
                        <form class="form-inline exam">
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
                                        <input type="radio" name="question{{ $question->id }}" value="0">A. {{ $question->A }}<br>
                                        <input type="radio" name="question{{ $question->id }}" value="1">B. {{ $question->B }}<br>
                                        <input type="radio" name="question{{ $question->id }}" value="2">C. {{ $question->C }}<br>
                                        <input type="radio" name="question{{ $question->id }}" value="3">D. {{ $question->D }}<br>
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
                            @endcannot
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
