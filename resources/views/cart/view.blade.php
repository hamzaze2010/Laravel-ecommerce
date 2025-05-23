@extends('User.userLayout')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                    <span>Shopping cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cartItems as $item)
                            <tr id="cart-item-{{ $item['product_id'] }}">
                                <td class="cart__product__item">
                                    <div class="cart__product__item__title">
                                        <h6>{{ $item['product']->name }}</h6>
                                        <!-- Example: Product Rating -->
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__quantity">
                                    <div>
                                        <img src="{{ asset('storage/' .  $item['image'] ) }}" alt="{{ $item['product']->name }}" style="width: 50px; height: 50px;">
                                    </div>
                                </td>
                                <td class="cart__price">{{ $item['price'] }}</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty" style="display: flex; align-items: center;">
                                        <button class="dec qtybtn" data-product-id="{{ $item['product_id'] }}" style="margin-right: 5px;">-</button>
                                        <input type="text" class="update-quantity" data-product-id="{{ $item['product_id'] }}" value="{{ $item['quantity'] }}" style="text-align: center; width: 50px;">
                                        <button class="inc qtybtn" data-product-id="{{ $item['product_id'] }}" style="margin-left: 5px;">+</button>
                                    </div>
                                </td>


                                <td class="cart__total">{{ $item['total'] }}</td>
                                <td class="cart__close">
                                    <a href="#" class="delete-cart-item" data-item-id="{{ $item['product_id'] }}">
                                        <span class="icon_close"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="{{ url('/') }}">Continue Shopping</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn update__btn">
                    <a href="#"><span class="icon_loading"></span> Update cart</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="discount__content">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal: <span>${{ $subtotal }}</span></li>
                        <li>Total: <span>${{ $total }}</span></li>
                    </ul>
                    <a href="{{ route('checkout')}}" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Cart Section End -->

@endsection
