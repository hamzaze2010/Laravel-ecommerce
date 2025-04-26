@extends('Admin.adminLayout')
@section('content')

<div class="col-xl-9">
    <div class="card card-default">
        <div class="card-header">
            <h2 class="mb-5">Add a User</h2>
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

            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="firstName">Name</label>
                            <input type="text" name="name" class="form-control" id="firstName">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                             @endif
                        </div>
                    </div>
                  
                    <div class="form-group col-lg-12">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="password">New password</label>
                        <input type="password" name="password" class="form-control" id="password">
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 mb-4">
                        <label for="address">Address</label>
                        <textarea name="address" class="form-control input-lg" id="address"></textarea>
                        @if($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 mb-4">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control input-lg" id="phone" placeholder="phone">
                        
                        @if($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
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

                    <div class="col-lg-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-2 btn-pill">Add User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
