@extends('User.userLayout')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                    <span>Checkout</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <form action="{{ route('checkout.placeOrder') }}" method="POST" class="checkout__form">
            @csrf
            <div class="row">
                <!-- Customer Address Section -->
                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Billing Details</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Address</span>
                                </li>
                                <li>
                                    <textarea name="address" class="form-control" rows="3" required>{{ old('address', $address) }}</textarea>
                                </li>
                            </ul>
                        </div>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Phone Number</span>
                                </li>
                                <li>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $phone) }}" required>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Payment Methods Section -->
                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Payment Methods</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <input type="radio" id="cod" name="payment_method" value="cod" class="form-check-input" required>
                                    <label for="cod" class="form-check-label">Cash on Delivery</label>
                                </li>
                                <li>
                                    <input type="radio" id="card" name="payment_method" value="card" class="form-check-input" required>
                                    <label for="card" class="form-check-label">Credit Card</label>
                                </li>
                                <li>
                                    <input type="radio" id="upi" name="payment_method" value="upi" class="form-check-input" required>
                                    <label for="upi" class="form-check-label">UPI</label>
                                </li>
                            </ul>
                        </div>

                        <!-- Credit Card Details -->
                        <div id="cardPaymentForm" class="payment-form mt-3" style="display: none;">
                            <h6 class="checkout__subtitle">Credit Card Details</h6>
                            <div class="checkout__form__input">
                                <p>Card Number <span>*</span></p>
                                <input type="text" name="card_number" class="form-control">
                            </div>
                            <div class="checkout__form__input">
                                <p>Expiration Date <span>*</span></p>
                                <input type="text" name="card_expiry" class="form-control">
                            </div>
                            <div class="checkout__form__input">
                                <p>CVV <span>*</span></p>
                                <input type="text" name="card_cvv" class="form-control">
                            </div>
                        </div>

                        <!-- UPI Details -->
                        <div id="upiPaymentForm" class="payment-form mt-3" style="display: none;">
                            <h6 class="checkout__subtitle">UPI Details</h6>
                            <div class="checkout__form__input">
                                <p>UPI ID <span>*</span></p>
                                <input type="text" name="upi_id" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cart Items Section -->
                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Your Order</h5>
                        <ul class="checkout__order__product">
                            <li>
                                <span class="top__text">Product</span>
                                <span class="top__text_right">Quantity</span>
                                <span class="top__text_right">Total</span>
                            </li>
                            @foreach ($cartItems as $item)
                                <li>
                                    <span>{{ $item['product']->name }}</span>
                                    <span>x{{ $item['quantity'] }}</span>
                                    <span>${{ $item['total'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="checkout__order__total">
                            <ul>
                                <li>Subtotal <span>${{ $subtotal }}</span></li>
                                <li>Total <span>${{ $subtotal }}</span></li>
                            </ul>
                        </div>
                        <button type="submit" class="site-btn">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Checkout Section End -->

@endsection
