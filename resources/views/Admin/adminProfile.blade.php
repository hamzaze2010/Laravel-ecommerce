@extends('Admin.adminLayout')
@section('content')

    

    <div class="card">
        <div class="card-header">
        <h1>Admin Profile</h1>
            
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($admin->image_path)
                        <img src="{{ asset('storage/admin/' . $admin->image_path) }}" alt="{{ $admin->name }}" class="img-thumbnail">
                    @else
                        <img src="{{ asset('storage/admin/default.jpg') }}" alt="Default Image" class="img-thumbnail">
                    @endif
                </div>
                <div class="col-md-8">
                    <p><strong>Gender:</strong> {{ $admin->name }}</p>
                    <p><strong>Email:</strong> {{ $admin->email }}</p>
                    <p><strong>Gender:</strong> {{ $admin->Gender }}</p>
                    <!-- Add more profile fields as necessary -->
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('editAdmin', ['id' => $admin->id]) }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>





@endsection