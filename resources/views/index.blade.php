@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{--  Learn/Test --}}
        <div class="col-md-3">
            <div class="row">
                <p><button type="button" class="btn btn-primary btn-lg btn-block">在线学习</button> </p>
                <p><button type="button" class="btn btn-primary btn-lg btn-block">在线考试</button> </p>
            </div>
        </div>
        {{-- System information --}}
        <div class="col-md-5">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="fa fa-info"></i> 系统提示</div>
                <div class="panel-body">
                    {!! $systeminfo->content !!}
                </div>
            </div>
        </div>
        {{-- Message/Info --}}
        <div class="col-md-4">
            {{-- Message --}}
            <div class="row">
                <div class="panel panel-danger">
                    <div class="panel-heading"><i class="icon-info-sign"></i> 最新公告</div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            @foreach($notices as $notice)
                                <li>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <a href="{{ url('article/'.$notice->id) }}"><i class="fa fa-bullhorn"></i> {{ str_limit($notice->title,25) }} </a>
                                        </div>
                                        <div class="col-md-4">
                                            {{ $notice->created_at->format('Y-m-d') }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            {{-- info --}}
            <div class="row">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-info btn-lg btn-block">规章制度</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-info btn-lg btn-block">事故案例</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-info btn-lg btn-block">安全标识</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-info btn-lg btn-block">安全讲座</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
