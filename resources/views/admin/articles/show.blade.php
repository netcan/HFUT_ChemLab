@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       <a href="{{ url('categories/'.$article->cid) }}">{{ $article->category->name }}</a> > {{ $article->title }}
                    </div>
                    <div class="panel-body">
                        <h1 class="article-heading">{{ $article->title }}</h1>
                        <p class="article-info">发布人：{{ $article->user->name }} 发布时间：{{ $article->created_at }}</p>
                        {!! $article->content !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
