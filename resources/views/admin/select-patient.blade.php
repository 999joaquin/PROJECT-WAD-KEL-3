@extends('layouts.layoutAdmin')
@section('title', 'Select Patient')
@section('content')
<div class="container mt-4">
    <h2>Select a Patient to Add Details</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">NIM</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
@endsection
