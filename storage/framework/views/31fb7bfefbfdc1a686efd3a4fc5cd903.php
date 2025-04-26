<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('img/logo.png')); ?>" alt=""></a>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt cilisis.</p>
                    <div class="footer__payment">
                        <a href="#"><img src="<?php echo e(asset('img/payment/payment-1.png')); ?>" alt=""></a>
                        <a href="#"><img src="<?php echo e(asset('img/payment/payment-2.png')); ?>" alt=""></a>
                        <a href="#"><img src="<?php echo e(asset('img/payment/payment-3.png')); ?>" alt=""></a>
                        <a href="#"><img src="<?php echo e(asset('img/payment/payment-4.png')); ?>" alt=""></a>
                        <a href="#"><img src="<?php echo e(asset('img/payment/payment-5.png')); ?>" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Quick links</h6>
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Blogs</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Account</h6>
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Orders Tracking</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">Wishlist</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <form action="#">
                        <input type="text" placeholder="Email">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
         
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="<?php echo e(asset('js/jquery-3.3.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/mixitup.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.countdown.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.slicknav.js')); ?>"></script>
<script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.nicescroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
<!-- Include MixItUp JavaScript Library -->
<script src="https://cdn.jsdelivr.net/npm/mixitup@3.3.1/dist/mixitup.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var containerEl = document.querySelector('#mix-container');
        var mixer = mixitup(containerEl, {
            selectors: {
                target: '.mix'
            },
            animation: {
                duration: 300
            }
        });

        // Optional: Change active class on filter controls
        var filterControls = document.querySelectorAll('.filter__controls li');
        filterControls.forEach(function(control) {
            control.addEventListener('click', function() {
                filterControls.forEach(function(c) { c.classList.remove('active'); });
                this.classList.add('active');
            });
        });
    });
</script>


<script>
$(document).ready(function() {
    // Add to wishlist using event delegation
    $(document).on('click', '.add-to-wishlist', function() {
        var productId = $(this).data('product-id');

        $.ajax({
            url: "<?php echo e(route('wishlist.add')); ?>",
            method: 'POST',
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                product_id: productId
            },
            success: function(response) {
                if (response.status === 'success') {
                    updateWishlistCount();
                }
            }
        });
    });

    // Function to update wishlist count
    function updateWishlistCount() {
        $.ajax({
            url: "<?php echo e(route('wishlist.count')); ?>",
            method: 'GET',
            success: function(response) {
                $('#wishlist-count').text(response.count);
            }
        });
    }

    // Initialize wishlist count on page load
    updateWishlistCount();
});

</script>


<script>
    $(document).ready(function () {
        // Function to update cart count in the UI
        function updateCartCount(count) {
            $('#cart-count').text(count);
        }

        // Function to fetch and update cart count from the server
        function fetchCartCount() {
            $.ajax({
                url: '/cart/count',
                method: 'GET',
                success: function (response) {
                    updateCartCount(response.cartCount);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Initial fetch of the cart count when page loads
        fetchCartCount();

        // Event listener for adding products to cart
        $('body').on('click', '.add-to-cart-btn', function (e) {
            e.preventDefault();
            let productId = $(this).data('product-id');

            $.ajax({
                url: '/cart/add/' + productId,
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    quantity: 1
                },
                success: function (response) {
                    if (response.status === 'success') {
                        updateCartCount(response.cartCount);
                        showMessage('Product added to cart successfully!', 'success');
                    } else {
                        showMessage(response.message || 'Failed to add product to cart.', 'error');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    showMessage('Something went wrong. Please try again.', 'error');
                }
            });
        });

        // Event listener for removing products from cart
        $('body').on('click', '.delete-cart-item', function (e) {
            e.preventDefault();
            let productId = $(this).data('item-id');

            $.ajax({
                url: '/cart/remove/' + productId,
                method: 'DELETE',
                data: { _token: '<?php echo e(csrf_token()); ?>' },
                success: function (response) {
                    if (response.status === 'success') {
                        showMessage(response.message, 'success');
                        $('#cart-item-' + productId).fadeOut(function () {
                            $(this).remove();
                            updateCartCount(response.cartCount);
                        });
                    } else {
                        showMessage(response.message, 'error');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    showMessage('Something went wrong. Please try again.', 'error');
                }
            });
        });

        // Function to show notification messages
        function showMessage(message, type) {
            let messageDiv = $('<div class="message ' + type + '">' + message + '</div>');
            $('body').append(messageDiv);
            setTimeout(function () {
                messageDiv.fadeOut(function () {
                    $(this).remove();
                });
            }, 2000);
        }
    });
</script>


<script>
    $(document).ready(function () {
        // Increment/Decrement Buttons
        $('body').on('click', '.qtybtn', function () {
            let button = $(this);
            button.prop('disabled', true); // Disable temporarily

            let productId = button.data('product-id');
            let inputField = button.siblings('.update-quantity');
            let currentQuantity = parseInt(inputField.val()) || 0;
            let newQuantity = button.hasClass('inc') ? currentQuantity + 1 : currentQuantity - 1;

            if (newQuantity <= 0) {
                alert('Quantity must be at least 1');
                button.prop('disabled', false);
                return;
            }

            inputField.val(newQuantity);

            $.ajax({
                url: '/cart/update-quantity',
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    product_id: productId,
                    quantity: newQuantity,
                },
                success: function (response) {
                    if (response.status === 'success') {
                        $('#cart-item-' + productId).find('.cart__total').text(response.itemTotal);
                        $('.cart__total__procced ul li span').text('$' + response.subtotal);
                    } else {
                        alert(response.message || 'Failed to update quantity.');
                    }
                },
                error: function () {
                    alert('An error occurred. Please try again.');
                },
                complete: function () {
                    button.prop('disabled', false);
                },
            });
        });
    });
</script>

<!-- script for checkout -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
        const cardPaymentForm = document.getElementById('cardPaymentForm');
        const upiPaymentForm = document.getElementById('upiPaymentForm');

        paymentRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'card') {
                    cardPaymentForm.style.display = 'block';
                    upiPaymentForm.style.display = 'none';
                } else if (this.value === 'upi') {
                    upiPaymentForm.style.display = 'block';
                    cardPaymentForm.style.display = 'none';
                } else {
                    cardPaymentForm.style.display = 'none';
                    upiPaymentForm.style.display = 'none';
                }
            });
        });
    });
</script>






















<?php /**PATH C:\wamp64\www\shopShatarat\resources\views/User/footer.blade.php ENDPATH**/ ?>