@extends('Admin.adminLayout')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<form action="{{ route('admin.update',$admins->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group col-md-12 mb-4">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control input-lg" id="name" value="{{$admins->name}}" placeholder="Name" required>
        @if($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="form-group col-md-12 mb-4">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control input-lg" value="{{$admins->email}}" id="email" aria-describedby="emailHelp" placeholder="Email" readonly>
        <!-- إذا كنت ترغب في عرض رسالة الخطأ في حالة محاولة التغيير -->
        @if($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
    
    <div class="form-group col-md-12 mb-4">
        <label for="password">Password</label>
        <!-- تحقق من وجود قيمة محفوظة في حقل كلمة المرور، وإذا كانت موجودة عرض الحقل -->
        <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password">
        @if($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>
    
    
    <div class="form-group col-md-12 mb-4">
        <label for="gender">Gender</label>
        <select name="gender" class="form-control input-lg" id="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
           
        </select>
        @if($errors->has('gender'))
            <span class="text-danger">{{ $errors->first('gender') }}</span>
        @endif
    </div>
    <div class="form-group col-md-12 mb-4">
        <label for="image">Image</label>
        <img src="{{ asset('storage/' . $admins->image_path) }}" alt="Admin Image" style="width: 50px; height: 50px; object-fit: cover;">

        <input type="file" name="image" class="form-control input-lg" id="image" >
        @if($errors->has('image'))
            <span class="text-danger">{{ $errors->first('image') }}</span>
        @endif
    </div>
    <button type="submit" class="btn btn-primary btn-lg">Update</button>
</form>

        
@endsection