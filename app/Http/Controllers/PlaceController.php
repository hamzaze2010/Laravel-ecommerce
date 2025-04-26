<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PlaceController extends Controller
{
    /**
     * Place an order.
     */
    public function placeOrder(Request $request)
{
    // Retrieve user details from session
    $userId = session()->get('user_id', null);
    $userName = session()->get('user_name', 'Guest User');
    $userEmail = session()->get('user_email', null);

    $user = $userId ? User::find($userId) : null;

    // Ensure user is logged in (if required)
    if (!$userId || !$user) {
        return redirect()->back()->with('error', 'User not logged in or session expired.');
    }

    // Validate required fields
    $validated = $request->validate([
        'address' => 'required|string',
        'phone' => 'required|string',
        'payment_method' => 'required|string|in:cod,card,upi',
    ]);

    // Retrieve the correct cart session key
    $cart = session('user_cart'); // Fixed key
    if (!$cart || empty($cart)) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    // Create new order
    $order = Order::create([
        'user_id' => $userId,
        'name' => $user ? $user->name : $userName, // Use database user name or session name
        'email' => $user ? $user->email : $userEmail, // Use database email or session email
        'address' => $validated['address'],
        'phone' => $validated['phone'],
        'subtotal' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), // Calculate subtotal dynamically
        'total_amount' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)), // Same as subtotal
        'payment_method' => $validated['payment_method'],
        'payment_status' => 'Pending',
        'order_status' => 'Pending',
    ]);

    // Save order items
    foreach ($cart as $productId => $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productId, // Corrected key usage
            'price' => $item['price'],
            'quantity' => $item['quantity'],
        ]);
    }

    // Handle different payment methods BEFORE clearing cart
    if ($validated['payment_method'] === 'card' || $validated['payment_method'] === 'upi') {
        $order->update(['payment_status' => 'Completed']);
    }

    // Clear cart session AFTER order is placed
    session()->forget('user_cart');

    // Redirect to success page
    return redirect()->route('order.success')->with('success', 'Order placed successfully!');
}

    


    /**
     * Show order success page.
     */
    public function orderSuccess()
    {
        // Retrieve the latest order for the logged-in user
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->route('checkout')->with('error', 'Session expired. Please log in again.');
        }

        // Fetch the latest order placed by the user
        $order = Order::where('user_id', $userId)
            ->latest()
            ->with(['orderItems' => function ($query) {
                $query->with('product');
            }])
            ->first();


            if (!$order->orderItems || $order->orderItems->isEmpty()) {
                return redirect()->route('checkout')->with('error', 'No order items found.');
            }            

        return view('order.success', compact('order'));
    }

    // Function to Download as PDF
    public function downloadReceipt($orderId)
{
    // Retrieve the order with order items
    $order = Order::with('orderItems.product')->findOrFail($orderId);

    // Load the receipt view into PDF
    $pdf = Pdf::loadView('order.receipt-pdf', compact('order'));

    // Return the PDF as a downloadable response
    return $pdf->download('Order_Receipt_' . $order->id . '.pdf');
}


    /**
     * View orders for a user.
     */
    // public function userOrders()
    // {
    //     $userId = session()->get('user_id');
    //     if (!$userId) {
    //         return redirect()->back()->with('error', 'User not logged in or session expired.');
    //     }

    //     $orders = Order::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

    //     return view('orders.user_orders', compact('orders'));
    // }

    // /**
    //  * View order details.
    //  */
    public function viewOrder($id)
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->back()->with('error', 'User not logged in or session expired.');
        }

        $order = Order::with('items.product')->findOrFail($id);

        if ($order->user_id !== $userId) {
            abort(403);
        }

        return view('orders.view_order', compact('order'));
    }

    /**
     * Admin - Update Order Status
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'order_status' => 'required|string|in:Pending,Confirmed,Canceled',
            'payment_status' => 'required|string|in:Pending,Completed,Failed',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}
