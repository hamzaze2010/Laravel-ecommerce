@extends('Admin.adminLayout')
@section('content')

@if(session('update_success'))
    <div class="alert alert-success">
        {{ session('update_success') }}
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
        <a class="btn btn-success mb-3" href="{{ route('createProduct')}}">Add a Product</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">price</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                
                
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td scope="row">{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category ? $product->category->name : 'No Category' }}</td>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" height="50" width="50"></td>
                    <td>{{ $product->status }}</td>
                    
                         
                    <td class="d-flex">
                        <a class="btn btn-info mr-2" href="{{ route('editProduct', ['id' => $product->id ])}}" role="button">Edit</a>
                        <form action="{{ route('deleteProduct', ['id' => $product->id ])}}" method="POST">
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
