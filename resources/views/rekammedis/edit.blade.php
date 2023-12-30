@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Edit Rekam Medis</h2>
        <form action="{{ route('rekammedis.update', $rekammedis->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="namaPasien">Nama Pasien:</label>
                <input type="text" class="form-control" id="namaPasien" name="namaPasien" value="{{ isset($rekammedis) ? $rekammedis->namaPasien : '' }}" required>
            </div>

            <div class="form-group">
                <label for="umur">Umur:</label>
                <input type="number" class="form-control" id="umur" name="umur" value="{{ isset($rekammedis) ? $rekammedis->umur : '' }}" required>
            </div>

            <div class="form-group">
                <label for="tglRekamMedis">Tanggal Rekam Medis:</label>
                <input type="date" class="form-control" id="tglRekamMedis" name="tglRekamMedis" value="{{ isset($rekammedis) ? $rekammedis->tglRekamMedis : '' }}" required>
            </div>

            <div class="form-group">
                <label for="diagnosis">Diagnosis:</label>
                <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3">{{ isset($rekammedis) ? $rekammedis->diagnosis : '' }}</textarea>
            </div>

            <div class="form-group">
                <label for="catatan">Catatan:</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ isset($rekammedis) ? $rekammedis->catatan : '' }}</textarea>
            </div>

            <!-- Add validation error messages here if needed -->

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
