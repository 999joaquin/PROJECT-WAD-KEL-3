@extends('layouts.layoutUser')
@section('title', 'Detail Article')
@section('content')

<div class="container">
    <h1>Article</h1>
    <div class="row">
        {{-- @foreach ($article as $article) --}}
            <div class="col-md-10">
                <div class="card" style="width: 64rem">
                    <div class="card-header">
                        <h4>{{ $singleArticle->title }}</h4>
                    </div>
                    <div class="card-body">
                        <p>{{ $singleArticle->paragraph }}</p>
                    </div>
                    <div class="card-footer">
                        <h6>{{ $singleArticle->author }}</h6>
                        <p>{{  $singleArticle->date_of_writing  }}</p>
                    </div>
                </div>
            </div>
        {{-- @endforeach --}}
    </div>
</div>

@endsection
