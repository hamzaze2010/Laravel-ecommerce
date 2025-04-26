@extends('Admin.adminLayout')
@section('content')

@if(session('update_success'))
    <div class="alert alert-success">
        {{ session('update_success') }}
    </div>
@endif

@if(session('success deleted'))
    <div class="alert alert-danger">
        {{ session('success deleted') }}
    </div>
@endif
<div class="container">
<div class="searchable">
    <div>
        <a class="btn btn-success" href="{{ route('createAdmin')}}">Add an Admin</a>
    </div>
    
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">Gender</th>
                <th scope="col">IMAGE</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td scope="row">{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->Gender }}</td>
                <td><img src="{{ asset('storage/' . $admin->image_path) }}" alt="{{ $admin->name }}" height="50" width="50"></td>
                <td class="d-flex">
                    <a class="btn btn-info mr-2" href="{{ route('editAdmin', ['id' => $admin->id ])}}" role="button">Edit</a>
                    <form action="{{ route('deleteAdmin', ['id' => $admin->id ])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
</div>

@endsection