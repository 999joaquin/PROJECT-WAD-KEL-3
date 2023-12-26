@extends('layouts.layout')
@section('title', 'Register')
@section('content')
<form method="POST" action="{{ route('register') }}" class="container-fluid mt-5" style="width: 500px">
    <h1>Registration Form</h1>
    @csrf
    <div class="form-group">
        <label>Full Name</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
        <label>Email address</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label>NIM</label>
        <input type="text" class="form-control" name="nim">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password">
    </div>
        <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection