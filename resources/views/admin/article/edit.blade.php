@extends('layouts.layoutAdmin')
@section('title', 'Edit Article')
@section('content')

<div class="container">
    <h1>Edit Artikel</h1>
    <form method="POST" action="{{ route('admin.articleUpdate', $singleArticle->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $singleArticle->title }}" required>
        </div>

        <div class="mb-3">
            <label for="paragraph" class="form-label">Isi Artikel</label>
            <input type="text" class="form-control" id="paragraph" name="paragraph" value="{{ $singleArticle->paragraph }}" required>

        <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $singleArticle->author }}" required>
        </div>

        <div class="mb-3">
            <label for="date_of_writing" class="form-label">Tanggal Penulisan</label>
            <input type="date" class="form-control" id="date_of_writing" name="date_of_writing" value="{{ $singleArticle->date_of_writing }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

</div>


@endsection