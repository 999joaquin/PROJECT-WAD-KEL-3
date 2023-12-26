@extends('layouts.layout')
@section('title', 'Login')
@section('content')
<form method="POST" action="{{ route('login') }}" class="container-fluid" style="width: 500px">
    <h1>Login</h1>
    @csrf
    <div class="form-group">
        <label>Email address</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</form>
@endsection
