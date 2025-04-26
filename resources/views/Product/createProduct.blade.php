@extends('Admin.adminLayout')
@section('content')


<div class="col-xl-9">
    <div class="card card-default">
        <div class="card-header">
            <h2 class="mb-5">Add a Product</h2>
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

            <form action="{{ route('storeProduct') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                        </div>
                        @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" id="price" class="form-control" name="price">
                        </div>
                        @if($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="disc_price">Discount Price</label>
                            <input type="number" id="disc_price" class="form-control" name="disc_price">
                        </div>
                        @if($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="quantity" rows="3" value="">
                        </div>
                        @if($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="hot_trend">Hot Trend</label>
                            <input type="hidden" name="hot_trend" value="0">
                            <input type="checkbox" class="form-control" name="hot_trend" id="hot_trend" value="1">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="best_seller">Best Seller</label>
                            <input type="hidden" name="best_seller" value="0">
                            <input type="checkbox" class="form-control" name="best_seller" id="best_seller" value="1">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="featured">Featured</label>
                            <input type="hidden" name="featured" value="0">
                            <input type="checkbox" class="form-control" name="featured" id="featured" value="1">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" class="form-control" id="category_id" required>
                                @foreach($categorys as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('category_id'))
                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
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

                    <div class="col-lg-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-2 btn-pill">Add a Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
