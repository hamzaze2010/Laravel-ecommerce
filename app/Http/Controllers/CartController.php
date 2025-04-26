<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart; // Make sure to include the Cart model

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $quantity = $request->input('quantity', 1); // Default quantity to 1 if not provided

        // Determine cart key based on login status
        $cartKey = session()->has('is_LoggedIn') ? 'user_cart' : 'cart';
        $sessionCart = session()->get($cartKey, []);

        // Handle session cart
        if (isset($sessionCart[$productId])) {
            // If product exists in session cart, update quantity
            $sessionCart[$productId]['quantity'] += $quantity;
        } else {
            // Retrieve product details from database
            $product = Product::find($productId);
            if (!$product) {
                return response()->json(['status' => 'error', 'message' => 'Product not found']);
            }

            // Add new product to session cart
            $sessionCart[$productId] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image,
            ];
        }

        // Save updated session cart
        session()->put($cartKey, $sessionCart);

        // Calculate the total quantity of items in the cart
        $cartCount = array_sum(array_column($sessionCart, 'quantity'));

        return response()->json(['status' => 'success', 'cartCount' => $cartCount]);
    }
    

    public function removeFromCart(Request $request, $productId)
    {
        $cartKey = session()->has('is_LoggedIn') ? 'user_cart' : 'cart';
        $cart = session()->get($cartKey, []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put($cartKey, $cart);
        }

        $cartCount = array_sum(array_column($cart, 'quantity'));
        return response()->json(['status' => 'success', 'message' => 'Product removed from cart.', 'cartCount' => $cartCount]);
    }

    public function viewCart()
    {
        $cartKey = session()->has('is_LoggedIn') ? 'user_cart' : 'cart';
        $cart = session()->get($cartKey, []);
        $cartItems = [];
        $subtotal = 0;

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
                    'image' => $product->image,
                ];
            }
        }

        $cartCount = array_sum(array_column($cartItems, 'quantity'));
        $total = $subtotal;

        return view('cart.view', compact('cartItems', 'cartCount', 'subtotal', 'total'));
    }

    public function syncCartOnLogin()
    {
        $guestCart = session()->get('cart', []);
        $userCart = session()->get('user_cart', []);

        foreach ($guestCart as $productId => $item) {
            if (!isset($userCart[$productId])) {
                $userCart[$productId] = [
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'image' => $item['image'],
                ];
            } else {
                $userCart[$productId]['quantity'] += $item['quantity'];
            }
        }

        session()->put('user_cart', $userCart);
        session()->forget('cart');
    }

    public function fetchCartCount()
    {
        $cartKey = session()->has('is_LoggedIn') ? 'user_cart' : 'cart';
        $cart = session()->get($cartKey, []);
        
        // Count distinct products, not their quantities
        $cartCount = count($cart);

        return response()->json(['cartCount' => $cartCount]);
    }
    public function checkout()
    {
        return view('order.view');
    }
    public function updateCartQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $newQuantity = $request->input('quantity');

        // Log for debugging
        \Log::info('updateCartQuantity called', [
            'product_id' => $productId,
            'new_quantity' => $newQuantity,
        ]);

        if ($newQuantity <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Quantity must be at least 1']);
        }

        $cartKey = session()->has('is_LoggedIn') ? 'user_cart' : 'cart';
        $sessionCart = session()->get($cartKey, []);

        if (!isset($sessionCart[$productId])) {
            return response()->json(['status' => 'error', 'message' => 'Product not found in cart']);
        }

        // Prevent redundant updates
        if ($sessionCart[$productId]['quantity'] === $newQuantity) {
            return response()->json(['status' => 'success', 'message' => 'Quantity already updated.']);
        }

        // Update the quantity
        $sessionCart[$productId]['quantity'] = $newQuantity;

        $itemTotal = $sessionCart[$productId]['quantity'] * $sessionCart[$productId]['price'];
        session()->put($cartKey, $sessionCart);

        $subtotal = array_reduce($sessionCart, function ($carry, $item) {
            return $carry + ($item['quantity'] * $item['price']);
        }, 0);

        return response()->json([
            'status' => 'success',
            'itemTotal' => '$' . number_format($itemTotal, 2),
            'subtotal' => number_format($subtotal, 2),
        ]);
    }



}
