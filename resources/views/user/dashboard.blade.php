@extends('layouts.layoutUser')
@section('title', 'Dashboard')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif