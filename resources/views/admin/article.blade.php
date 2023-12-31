@extends('layouts.layoutAdmin')
@section('title', 'Article')
@section('content')

<div>
    <center>
        <a style="margin-top: 10px" class="btn btn-primary" href="{{ route('admin.articleCreate') }}">Tambah Artikel</a>
        <ul>
            <div class="card" style="width: 80rem; margin-top: 24px; margin-right: 48px">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($article as $article)
                    <tr>
                        <td>
                            {{ $article->id }}
                        </td>
                        <td>
                            {{ $article->title }}
                        </td>
                        <td>
                            {{ $article->date_of_writing }}
                        </td>
                        <td>
                            <a class="btn btn-outline-secondary" href="{{ route('admin.articleDetail', $article->id) }}">Lihat Artikel</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </ul>
    </center>
</div>

@endsection
