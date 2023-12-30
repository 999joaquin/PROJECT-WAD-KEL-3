@extends('layouts.layoutAdmin')
@section('title', 'View Medicine')
@section('content')
<div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Medicine</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <a href="{{ route('admin.addMedicines') }}" class="btn btn-primary mb-0">Add Medicine</a>
                        <a></a> 
                            <th>Nama Obat</th>
                            <th>No Regis</th>
                            <th>Harga</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obato as $obat)
                            <tr>
                                <td>{{ $obat->nama_obat }}</td>
                                <td>{{ $obat->noregis }}</td>
                                <td>{{ $obat->harga }}</td>
                                <td>{{ $obat->stock }}</td>
                                <td>
                                   <a href="{{ route('admin.detailMedicine', $obat->id) }}" class="btn btn-primary">Detail</a>
                                   <a href="{{ route('admin.editMedicines', $obat->id) }}" class="btn btn-primary">Edit</a>
                                   
                                </td>
                            </tr>
                        @endforeach
                        @if($obato->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">No Medicine Found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    








@endsection