<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Middleware\AdminMiddleware; 
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Category\categoryController;
use App\Http\Controllers\Product\productController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\Order\AdminOrderController;



Route::get('/', function () {
    return view('welcome');
});





Auth::routes();

//Admin Related Routes: 

Route::post('/admin_login', [AdminLoginController::class, 'login'])->name('admin_login'); // admin login ka weeye
Route::get('/loginadmin', [AdminLoginController::class, 'admin_default_page'])->name('admin_default_page'); // admin login


//Admin Reset Password Routes

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');



Route::middleware(['admin'])->group(function () {
    Route::get('/Adminindex', [AdminLoginController::class, 'index'])->name('Adminindex');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Admin Management
    Route::get('/adminManage', [AdminLoginController::class, 'adminManage'])->name('adminManage');
    Route::get('/createAdmin', [AdminLoginController::class, 'create'])->name('createAdmin');
    Route::post('/createAdmin', [AdminLoginController::class, 'store'])->name('admin.store');
    Route::post('/admin.update{id}', [AdminLoginController::class, 'update'])->name('admin.update');
    Route::get('/editAdmin/{id}', [AdminLoginController::class, 'edit'])->name('editAdmin');
    Route::delete('/deleteAdmin/{id}', [AdminLoginController::class, 'destroy'])->name('deleteAdmin');
    Route::get('/profileAdmin/{id}', [AdminLoginController::class, 'profileAdmin'])->name('profileAdmin');
    // Route::get('/adminSearch', [AdminLoginController::class, 'search'])->name('admin_search');

    // Categories
    Route::get('/categoryManage', [CategoryController::class, 'categoryManage'])->name('categoryManage');
    Route::get('/createCategory', [CategoryController::class, 'create'])->name('createCategory');
    Route::post('/createCategory', [CategoryController::class, 'store'])->name('storeCategory');
    Route::get('/editCategory/{id}', [CategoryController::class, 'edit'])->name('editCategory');
    Route::post('/updateCategory/{id}', [CategoryController::class, 'update'])->name('updateCategory');
    Route::delete('/deleteCategory/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');

    // Products
    Route::get('/productManage', [ProductController::class, 'indexProduct'])->name('productManage');
    Route::get('/createProduct', [ProductController::class, 'create'])->name('createProduct');
    Route::post('/createProduct', [ProductController::class, 'store'])->name('storeProduct');
    Route::get('/editProduct/{id}', [ProductController::class, 'edit'])->name('editProduct');
    Route::post('/updateProduct/{id}', [ProductController::class, 'update'])->name('updateProduct');
    Route::delete('/deleteProduct/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');
    

    // UserManage
    Route::get('/userManage', [UserController::class, 'indexUser'])->name('userManage');
    Route::get('/createUser', [UserController::class, 'create'])->name('createUser');
    Route::post('/user.store', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit.User/{id}', [UserController::class, 'editUser'])->name('edit.User');
    Route::post('/user.update{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/deleteUser/{id}', [UserController::class, 'destroy'])->name('deleteUser');

    Route::post('/orders/{id}/update', [PlaceController::class, 'updateOrderStatus'])->name('admin.orders.update');

    

    // OrderManage
    Route::get('/orders-list', [AdminOrderController::class, 'index'])->name('admin.order.manage'); 
    Route::get('/order-view/{id}', [AdminOrderController::class, 'show'])->name('orderview');  // Fetch Order Details (AJAX)
    Route::post('/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/admin/order/{id}/download-receipt', [AdminOrderController::class, 'downloadReceipt'])->name('admin.order.downloadReceipt');



});






// User Related Routes:
Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/userlogin', [UserController::class, 'user_login_page'])->name('userLogin');
Route::get('/userRegister', [UserController::class, 'user_register_page'])->name('userRegister');
Route::post('/user_register', [UserController::class, 'register'])->name('user_register');
Route::post('/user_login', [UserController::class, 'login'])->name('user_login');// user login ka weeye
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist/count', [WishlistController::class, 'count'])->name('wishlist.count');
Route::get('/wishlist/status', [WishlistController::class, 'status'])->name('wishlist.status');
Route::get('/wishlist/page', [WishlistController::class, 'wishlist_page'])->name('wishlist.status');




Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/view', [CartController::class, 'viewCart'])->name('cart.view');
Route::get('/cart/count', [CartController::class, 'fetchCartCount']);
Route::post('/cart/update-quantity', [CartController::class, 'updateCartQuantity']);

//cart
Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout');







Route::middleware(['user'])->group(function () {
    // Route::get('/Userindex', [UserController::class, 'index'])->name('Userindex');
    Route::post('/userlogout', [UserController::class, 'logout'])->name('user_logout');
    Route::get('/userProfile/{id}', [UserController::class, 'profileUser'])->name('userProfile');
    Route::get('/editUser/{id}', [UserController::class, 'edit'])->name('editUser');


    Route::post('/checkout/place-order', [PlaceController::class, 'placeOrder'])->name('checkout.placeOrder'); // Order Success
    Route::get('/orders/success', [PlaceController::class, 'orderSuccess'])->name('order.success'); // User Orders
    Route::get('/orders', [PlaceController::class, 'userOrders'])->name('orders.user'); // View Single Order
    Route::get('/orders/{id}', [PlaceController::class, 'viewOrder'])->name('orders.view');
    Route::get('/order/{id}/download-receipt', [PlaceController::class, 'downloadReceipt'])->name('order.downloadReceipt');
});    



 