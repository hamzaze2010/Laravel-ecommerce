@extends('Admin.adminLayout')
@section('content')

<div class="col-xl-9">
    <div class="card card-default">
        <div class="card-header">
            <h2 class="mb-5">Edit a Category</h2>
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

            <form action="{{ route('updateCategory', ['id'=>$categorys->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$categorys->name}}">
                        </div>
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="col-lg-12">
                    <label for="image">Image</label>
                        <div class="form-group">
                        
                            <img src="{{ asset('storage/' . $categorys->image) }}" alt="Admin Image" style="width: 50px; height: 50px; object-fit: cover;">
                            
                            
                            <input type="file" id="image" name="image" class="form-control-file" value="{{$categorys->image}}">

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
                                <option value="active" @if($categorys->status == 'active') selected @endif>Active</option>
                                <option value="inactive" @if($categorys->status == 'inactive') selected @endif>Inactive</option>
                            </select>
                        </div>
                        @if($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3">{{ $categorys->description }}</textarea>
                        </div>
                        @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    

                    <div class="col-lg-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-2 btn-pill">Update Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
