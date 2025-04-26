@extends('Admin.adminLayout')
@section('content')

@if(session('success created'))
    <div class="alert alert-success">
        {{ session('success created') }}
    </div>
@endif

@if(session('success update'))
    <div class="alert alert-success">
        {{ session('success update') }}
    </div>
@endif

@if(session('success deleted'))
    <div class="alert alert-danger">
        {{ session('success deleted') }}
    </div>
@endif

<div class="container">
<div class="searchable">
    <div class="mb-3">
        <a class="btn btn-success" href="{{ route('createUser') }}">Add a User</a>
    </div>
    
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">ADDRESS</th>
                <th scope="col">PHONE</th>
                <th scope="col">IMAGE</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td scope="row">{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->phone }}</td>
                <td><img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" height="50" width="50"></td>
                <td class="d-flex">
                    <a class="btn btn-info mr-2" href="{{ route('edit.User', ['id' => $user->id ]) }}" role="button">Edit</a>
                    <form action="{{ route('deleteAdmin', ['id' => $user->id ]) }}" method="POST">
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

<!-- Pagination links -->
<div class="justify-content-center">
    {{ $users->links() }}
</div>
</div>
<div id="search-results"></div>
@endsection
