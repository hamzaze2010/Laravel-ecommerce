@extends('Admin.adminLayout')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('success created'))
    <div class="alert alert-success">
        {{ session('success created') }}
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
        <a class="btn btn-success mb-3" href="{{ route('createCategory')}}">Add a Category</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Description</th>
                
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorys as $category)
                <tr>
                    <td scope="row">{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td><img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" height="50" width="50"></td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->description }}</td>
                         
                    <td class="d-flex">
                        <a class="btn btn-info mr-2" href="{{ route('editCategory', ['id' => $category->id ])}}" role="button">Edit</a>
                        <form action="{{ route('deleteCategory', ['id' => $category->id ])}}" method="POST">
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
</div>
<div id="search-results"></div>
@endsection
