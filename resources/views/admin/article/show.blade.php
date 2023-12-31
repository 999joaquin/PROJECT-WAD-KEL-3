@extends('layouts.layoutAdmin')
@section('title', 'Article')
@section('content')

<div class="container">
    <h1>Article</h1>
    <div class="row">
        @foreach ($article as $article)
            <div class="col-md-10">
                <div class="card" style="width: 64rem">
                    <div class="card-header">
                        <h4>{{ $article->title }}</h4><p>{{ $article->id }}</p>
                    </div>
                    <div class="card-body">
                        <p>{{ $article->paragraph }}</p>
                    </div>
                    <div class="card-footer">
                        <h6>{{ $article->author }}</h6>
                        <p>{{  $article->date_of_writing  }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
