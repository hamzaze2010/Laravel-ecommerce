@component('mail::message')
# Order Update Notification

Dear {{ $order->user ? $order->user->name : 'Customer' }},

Your order **#{{ $order->id }}** has been updated.

**Order Status:** {{ ucfirst($order->order_status) }}  
**Payment Status:** {{ ucfirst($order->payment_status) }}

@component('mail::button', ['url' => route('orders.view', $order->id)])
View Order Details
@endcomponent

Thank you for shopping with us!

Regards,  
{{ config('app.name') }}
@endcomponent
