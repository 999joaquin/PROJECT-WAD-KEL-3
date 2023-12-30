@extends('layouts.layoutAdmin')
@section('title', 'Add Medicine')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1>Add Medicine</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.addMedicine') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_obat">Medicine Name:</label>
                        <input type="text" id="nama" name="nama_obat" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="harga">Price:</label>
                        <input type="text" id="harga" name="harga" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="noregis">Registation Number:</label>
                        <input type="text" id="noregis" name="noregis" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input type="number" id="stock" name="stock" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Description:</label>
                        <input type="text" id="deskripsi" name="deskripsi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="efek_samping">Side Effect:</label>
                        <input type="text" id="efek_samping" name="efek_samping" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="golongan">Groups:</label>
                        <input type="text" id="golongan" name="golongan" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Medicine</button>
                </form>
                
            </div>
        </div>
        <div class="mt-2">
            <a href="{{ route('admin.showMedicine') }}" class="btn btn-secondary mb-3">View Medicine</a> 
        </div>
    </div>



@endsection