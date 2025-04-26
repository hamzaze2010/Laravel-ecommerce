@extends('User.userLayout')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                    <span>Order</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Order Section Begin -->
<section class="order spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h5>Billing detail</h5>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="checkout__form__input">
                            <p>First Name <span>*</span></p>
                            <input type="text" value="{{ $order->first_name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="checkout__form__input">
                            <p>Last Name <span>*</span></p>
                            <input type="text" value="{{ $order->last_name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="checkout__form__input">
                            <p>Country <span>*</span></p>
                            <input type="text" value="{{ $order->country }}" readonly>
                        </div>
                        <div class="checkout__form__input">
                            <p>Address <span>*</span></p>
                            <input type="text" value="{{ $order->address }}" readonly>
                        </div>
                        <div class="checkout__form__input">
                            <p>Town/City <span>*</span></p>
                            <input type="text" value="{{ $order->city }}" readonly>
                        </div>
                        <div class="checkout__form__input">
                            <p>Country/State <span>*</span></p>
                            <input type="text" value="{{ $order->state }}" readonly>
                        </div>
                        <div class="checkout__form__input">
                            <p>Postcode/Zip <span>*</span></p>
                            <input type="text" value="{{ $order->postcode }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="checkout__form__input">
                            <p>Phone <span>*</span></p>
                            <input type="text" value="{{ $order->phone }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="checkout__form__input">
                            <p>Email <span>*</span></p>
                            <input type="text" value="{{ $order->email }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="checkout__order">
                    <h5>Your order</h5>
                    <div class="checkout__order__product">
                        <ul>
                            <li>
                                <span class="top__text">Product</span>
                                <span class="top__text__right">Total</span>
                            </li>
                            @foreach ($order->orderItems as $item)
                                <li>{{ $item->product->name }} <span>${{ $item->total }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="checkout__order__total">
                        <ul>
                            <li>Subtotal <span>${{ $order->subtotal }}</span></li>
                            <li>Total <span>${{ $order->total }}</span></li>
                        </ul>
                    </div>
                    <div class="checkout__order__widget">
                        <label for="o-acc">
                            Create an acount?
                            <input type="checkbox" id="o-acc">
                            <span class="checkmark"></span>
                        </label>
                        <p>Create am acount by entering the information below. If you are a returing customer
                        login at the top of the page.</p>
                        <label for="check-payment">
                            Cheque payment
                            <input type="checkbox" id="check-payment">
                            <span class="checkmark"></span>
                        </label>
                        <label for="paypal">
                            PayPal
                            <input type="checkbox" id="paypal">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Order Section End -->

@endsection
