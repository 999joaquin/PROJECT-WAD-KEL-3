@extends('layouts.layoutAdmin')
@section('title', 'Create Article')
@section('content')

<div class="container">
    <h1>Tambah Artikel</h1>
    <form action="{{ route('admin.store') }}" method="POST"> @csrf
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="paragraph">Isi Berita</label>
                    <textarea type="text" class="form-control" id="paragraph" name="paragraph" required></textarea>
                </div>
                <div class="form-group">
                    <label for="author">Penulis</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <div class="form-group">
                    <label for="date_of_writing">Tanggal Penulisan</label>
                    <input type="date" class="form-control" id="date_of_writing" name="date_of_writing" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>


@endsection