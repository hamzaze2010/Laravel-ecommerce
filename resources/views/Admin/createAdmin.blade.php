@extends('Admin.adminLayout')
@section('content')

<div class="col-xl-9">
    <div class="card card-default">
        <div class="card-header">
            <h2 class="mb-5">Add an Admin</h2>
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

            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group col-md-12 mb-4">
                       
                            <label for="firstName">Name</label>
                            <input type="text" name="name" class="form-control input-lg" id="firstName">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                             @endif
                        
                    </div>
                  
                    <div class="form-group col-md-12 mb-4">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control input-lg" id="email">
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 mb-4">
                        <label for="password">New password</label>
                        <input type="password" name="password" class="form-control input-lg" id="password">
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 mb-4">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" name="password_confirmation" class="form-control input-lg" id="password_confirmation">
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 mb-4">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control input-lg" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @if($errors->has('gender'))
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 mb-4">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control-file">
                        </div>
                        @if($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                    </div>

                    <div class="col-lg-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-2 btn-pill">Add Admin</button>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection
