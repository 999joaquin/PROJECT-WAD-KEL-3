@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Detail Rekam Medis</h2>
        <div>
            <strong>ID:</strong> {{ $rekamMedis->id }} <br>
            <strong>Patient ID:</strong> {{ $rekamMedis->patient_id }} <br>
            <strong>Nama Pasien:</strong> {{ $rekamMedis->nama_pasien }} <br>
            <strong>Umur:</strong> {{ $rekamMedis->umur }} <br>
            <strong>Tanggal Rekam Medis:</strong> {{ $rekamMedis->tanggal_rekammedis }} <br>
            <strong>Diagnosis:</strong> {{ $rekamMedis->diagnosis }} <br>
            <strong>Catatan:</strong> {{ $rekamMedis->catatan }} <br>
        </div>
        <a href="{{ route('rekammedis.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
