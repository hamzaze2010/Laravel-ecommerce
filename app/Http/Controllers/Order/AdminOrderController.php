<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\OrderStatusUpdated;
use Illuminate\Support\Facades\Mail;


class AdminOrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        // Optionally, you can add filtering/sorting here
        $orders = Order::latest()->paginate(5);

        return view('Admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order details via AJAX.
     */
    public function show($id)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($id);
        return view('Admin.orders.order_details', compact('order'));
    }


    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'order_status'   => 'required|string|in:Pending,Confirmed,Canceled',
            'payment_status' => 'required|string|in:Pending,Completed,Failed',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'order_status'   => $validated['order_status'],
            'payment_status' => $validated['payment_status'],
        ]);

        // Send email notification to the customer if email is set
        if ($order->user && $order->user->email) {
            Mail::to($order->user->email)->send(new OrderStatusUpdated($order));
        }

        return redirect()->back()->with('update_success', 'Order status updated successfully!');
    }

    public function downloadReceipt($id)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($id);

        $pdf = PDF::loadView('Admin.orders.receipt_pdf', compact('order'));

        return $pdf->download('Order_' . $order->id . '_Receipt.pdf');
    }



    
    // You can add methods for updating order/payment status, downloading invoices, etc.
}
