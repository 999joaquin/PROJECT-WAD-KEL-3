@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>{{ isset($rekammedis) ? 'Edit Rekam Medis' : 'Tambah Rekam Medis' }}</h2>
        <form action="{{ isset($rekammedis) ? route('rekammedis.update', $rekammedis->id) : route('rekammedis.store') }}" method="POST">
            @csrf
            @if (isset($rekammedis))
                @method('PUT')
            @endif

            <!-- Update patient_id field -->
            <div class="form-group">
                <label for="patient_id">Patient ID:</label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" value="{{ isset($rekammedis) ? $rekammedis->patient_id : '' }}" required>
            </div>


            <div class="form-group">
                <label for="nama_pasien">Nama Pasien:</label>
                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="{{ isset($rekammedis) ? $rekammedis->nama_pasien : '' }}" required>
            </div>

            <div class="form-group">
                <label for="umur">Umur:</label>
                <input type="number" class="form-control" id="umur" name="umur" value="{{ isset($rekammedis) ? $rekammedis->umur : '' }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal_rekammedis">Tanggal Rekam Medis:</label>
                <input type="date" class="form-control" id="tanggal_rekammedis" name="tanggal_rekammedis" value="{{ isset($rekammedis) ? $rekammedis->tanggal_rekammedis : '' }}" required>
            </div>

            <div class="form-group">
                <label for="diagnosis">Diagnosis:</label>
                <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" required>{{ isset($rekammedis) ? $rekammedis->diagnosis : '' }}</textarea>
            </div>

            <div class="form-group">
                <label for="catatan">Catatan:</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ isset($rekammedis) ? $rekammedis->catatan : '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($rekammedis) ? 'Update' : 'Tambah' }}</button>
        </form>
    </div>
@endsection
