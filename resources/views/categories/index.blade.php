@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $categoryName }}
                    </div>
                    <div class="panel-body">
                        <a class="btn btn-success btn-raised" href="{{ url('categories/') }}">显示全部 <span class="badge">{{ $articles_count }}</span></a>
                        @foreach($categories as $category)
                            <a class="btn btn-info btn-raised" href="{{ url('categories/'.$category->id) }}">{{ $category->name }} <span class="badge">{{ $category->articles_count }}</span></a>
                        @endforeach
                        <br><br>
                        <ul class="list-unstyled">
                            @foreach($articles as $article)
                                <div class="row">
                                    <li class="col-md-10"><a href="{{ url('article/'.$article->id) }}"> {{ str_limit($article->title, 100) }} </a></li>
                                    <li class="col-md-2"> {{ $article->created_at->format('Y-m-d') }} </li>
                                </div>
                            @endforeach
                        </ul>
                        <div class="text-center">
                            @if($articles)
                            {{ $articles->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
