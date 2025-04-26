@extends('Admin.adminLayout')
@section('content')

<div class="col-xl-9">
    <div class="card card-default">
        <div class="card-header">
            <h2 class="mb-5">Add a Category</h2>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('storeCategory') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control-file">
                        </div>
                        @if($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        @if($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                        </div>
                        @if($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="col-lg-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-2 btn-pill">Add Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
