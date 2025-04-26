<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="Hamza_shop, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hamza</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('css/elegant-icons.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('css/jquery-ui.min.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('css/magnific-popup.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('css/slicknav.min.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>" type="text/css">
    <style>
        .message {
            position: fixed;
            top: 130px; /* Adjust this value to match your fixed header height */
            right: 10px;
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
            color: #fff;
        }
        .message.success {
            background-color: #4caf50;
        }
        .message.info {
            background-color: #f44336;
        }
        .message.error {
            background-color: #f44336;
        }
    
        body {
            padding-top: 100px; /* Adjust based on your header height */
        }
        .header {
            position: fixed;
            width: 100%;
            top: 0;
            background-color: #fff; /* Your header background color */
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Add shadow */
        }
        .content {
            padding-top: 30px; /* Adjust to match your header height + extra space */
            /* Other styles for content section */
        }
    </style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('img/logo.png')); ?>" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="<?php echo e(route('userLogin')); ?>">Login</a>
            <a href="<?php echo e(route('userRegister')); ?>">Register</a>
        </div>
    </div>
<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('img/logo.jpeg')); ?>" alt="Logo" style="width: 75px; height: 75px;"></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li><a href="#">Women’s</a></li>
                        <li><a href="#">Men’s</a></li>
                        <li><a href="<?php echo e(url('/shop')); ?>">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="<?php echo e(url('/product-details')); ?>">Product Details</a></li>
                                <li><a href="<?php echo e(url('/shop-cart')); ?>">Shop Cart</a></li>
                                <li><a href="<?php echo e(url('/checkout')); ?>">Checkout</a></li>
                                <li><a href="<?php echo e(url('/blog-details')); ?>">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo e(url('/blog')); ?>">Blog</a></li>
                        <li><a href="<?php echo e(url('/contact')); ?>">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        <?php if(session('is_LoggedIn')): ?>
                            <div class="dropdown-footer">
                                <form id="logout-form" action="<?php echo e(route('user_logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                                <a  href="<?php echo e(route('user_logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                           </div>
                        <?php else: ?>
                            <a href="<?php echo e(route('userLogin')); ?>">Login</a>
                            <a href="<?php echo e(route('userRegister')); ?>">Register</a>
                        <?php endif; ?>
                    </div>
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        
                        <li><a href="#"><span class="icon_heart_alt"></span><div class="tip" id="wishlist-count">0</div></a></li>
                        <li>
                            <a href="<?php echo e(route('cart.view')); ?>" id="cart-icon-link">
                                <span class="icon_bag_alt"></span>
                                <div class="tip" id="cart-count"><?php echo e($cartCount); ?></div>
                            </a>
                        </li>



                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
<?php /**PATH C:\wamp64\www\shopShatarat\resources\views/User/header.blade.php ENDPATH**/ ?>