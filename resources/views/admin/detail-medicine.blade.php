@extends('layouts.layoutAdmin')
@section('title', 'Detail Medicine')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1>Detail Medicine</h1>
            </div>
                <div class="card-body">
                <a href="{{ route('admin.showMedicine') }}" class="btn btn-primary mb-0">Kembali</a>   
                        <div class="form-group">
                            <label for="nama_obat">Medicine Name:</label>
                            <input type="text" id="nama" name="nama_obat" class="form-control" value="{{$id->nama_obat}}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="harga">Price:</label>
                            <input type="text" id="harga" name="harga" class="form-control" value="{{$id->harga}}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="noregis">Registation Number:</label>
                            <input type="text" id="noregis" name="noregis" class="form-control" value="{{$id->noregis}}"readonly>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" id="stock" name="stock" class="form-control" value="{{$id->stock}}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Description:</label>
                            <input type="text" id="deskripsi" name="deskripsi" class="form-control" value="{{$id->deskripsi}}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="efek_samping">Side Effect:</label>
                            <input type="text" id="efek_samping" name="efek_samping" class="form-control" value="{{$id->efek_samping}}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="golongan">Groups:</label>
                            <input type="text" id="golongan" name="golongan" class="form-control" value="{{$id->golongan}}" readonly>
                        </div>

                        <form action="{{route('admin.deleteMedicine', $id) }}" class="form-delete" method="POST" onsubmit="return confirm('Ingin Menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="form-button-secondary">Delete</button>
                        </form>
                </div>
        </div>
    </div>



@endsection