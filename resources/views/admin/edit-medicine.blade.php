@extends('layouts.layoutAdmin')
@section('title', 'Edit Medicine')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1>Edit        Medicine</h1>
            </div>
            <div class="card-body">
            <a href="{{ route('admin.showMedicine') }}" class="btn btn-secondary mb-3">Kembali</a> 
                <form action="{{ route('admin.updateMedicine', ['id'=>$id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="nama_obat">Medicine Name:</label>
                        <input type="text" id="nama" name="nama_obat" class="form-control" value="{{$id->nama_obat}}">
                    </div>

                    <div class="form-group">
                        <label for="harga">Price:</label>
                        <input type="text" id="harga" name="harga" class="form-control" value="{{$id->harga}}">
                    </div>

                    <div class="form-group">
                        <label for="noregis">Registation Number:</label>
                        <input type="text" id="noregis" name="noregis" class="form-control" value="{{$id->noregis}}">
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input type="number" id="stock" name="stock" class="form-control" value="{{$id->stock}}">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Description:</label>
                        <input type="text" id="deskripsi" name="deskripsi" class="form-control" value="{{$id->deskripsi}}">
                    </div>

                    <div class="form-group">
                        <label for="efek_samping">Side Effect:</label>
                        <input type="text" id="efek_samping" name="efek_samping" class="form-control" value="{{$id->efek_samping}}">
                    </div>

                    <div class="form-group">
                        <label for="golongan">Groups:</label>
                        <input type="text" id="golongan" name="golongan" class="form-control" value="{{$id->golongan}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Medicine</button>
                </form>
                
            </div>
        </div>
        <div class="mt-2">
            
        </div>
    </div>



@endsection