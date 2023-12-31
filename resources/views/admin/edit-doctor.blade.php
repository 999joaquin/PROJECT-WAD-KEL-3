@extends('layouts.layoutAdmin')
@section('title', 'Edit Doctor')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Doctor</div>
                <div class="card-body">
                    <form action="{{ route('admin.updateDoctor', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <input type="text" id="name" name="name" class="form-control" value="{{ $doctor->name }}" required>
                            <label for="name">Doctor's Name:</label>
                        </div>

                        <div class="form-group">
                            <input type="text" id="specialization" name="specialization" class="form-control" value="{{ $doctor->specialization }}" required>
                            <label for="specialization">Specialization:</label>
                        </div>

                        <div class="form-group">
                            <input type="text" id="education" name="education" class="form-control" value="{{ $doctor->education }}" required>
                            <label for="education">Education:</label>
                        </div>

                        <div class="form-group">
                            <input type="file" id="image" name="image" class="form-control-file">
                            <label for="image">Doctor's Image</label>
                            @if($doctor->image != 'noimage.jpg')
                                <div class="mt-2">
                                    <img src="{{ asset('storage/images/'.$doctor->image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Update Doctor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
