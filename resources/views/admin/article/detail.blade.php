@extends('layouts.layoutAdmin')
@section('title', 'Detail Article')
@section('content')

<div class="container">
    <center><h1>Article</h1></center>
    <div class="row">
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
                <a style="margin-top: 12px" href="{{ route('admin.articleEdit', $singleArticle->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('admin.articleDelete', $singleArticle->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button style="margin-top: 12px" type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
    </div>
</div>

@endsection
