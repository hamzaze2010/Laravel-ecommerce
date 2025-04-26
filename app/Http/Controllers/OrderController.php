<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

class OrderController extends Controller
{
    public function showCheckoutForm()
    {
        // Check if the user is logged in
        if (!session()->has('is_LoggedIn')) {
            return redirect()->route('userLogin')->with('message', 'You must log in to checkout.');
        }
    
        // Retrieve the cart from the session
        $cartKey = session()->has('user_id') ? 'user_cart' : 'cart';
        $cart = session()->get($cartKey, []);
        $cartItems = [];
        $subtotal = 0;
    
        // Calculate the subtotal and prepare cart items for the view
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $total = $item['quantity'] * $product->price;
                $subtotal += $total;
                $cartItems[] = [
                    'product_id' => $productId,
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'total' => $total,
                ];
            }
        }
    
        // Retrieve user information from the session
        $isLoggedIn = session('is_LoggedIn');
        $userId = session('user_id');
        $userName = session('user_name');
        $userEmail = session('user_email');
        $userImage = session('user_image');
        $address = session('address');
        $phone = session('phone');
        
    
        // Calculate the total
        $total = $subtotal;

        // Return the checkout view with the necessary data
        return view('User.checkout', compact('cartItems', 'subtotal', 'total', 'isLoggedIn', 'userId', 'userName', 'userEmail', 'userImage', 'address', 'phone'));
        
    }
}
