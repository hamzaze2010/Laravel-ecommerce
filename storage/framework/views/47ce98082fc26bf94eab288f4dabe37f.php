
<?php $__env->startSection('content'); ?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i> Home</a>
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
        <form action="<?php echo e(route('checkout.placeOrder')); ?>" method="POST" class="checkout__form">
            <?php echo csrf_field(); ?>
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
                                    <textarea name="address" class="form-control" rows="3" required><?php echo e(old('address', $address)); ?></textarea>
                                </li>
                            </ul>
                        </div>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Phone Number</span>
                                </li>
                                <li>
                                    <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone', $phone)); ?>" required>
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
                            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <span><?php echo e($item['product']->name); ?></span>
                                    <span>x<?php echo e($item['quantity']); ?></span>
                                    <span>$<?php echo e($item['total']); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="checkout__order__total">
                            <ul>
                                <li>Subtotal <span>$<?php echo e($subtotal); ?></span></li>
                                <li>Total <span>$<?php echo e($subtotal); ?></span></li>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('User.userLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\shopShatarat\resources\views/User/checkout.blade.php ENDPATH**/ ?>