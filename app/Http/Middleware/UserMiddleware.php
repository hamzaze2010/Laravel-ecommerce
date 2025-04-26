<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CartController;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Session::has('is_LoggedIn')) {
            return redirect()->route('userLogin')->with('error', 'You must log in to proceed.');
        }
        
        // Synchronize cart if user logs in
        $this->syncCart();

        return $next($request);
    }

    /**
     * Synchronize cart between guest and logged-in user.
     */
    protected function syncCart()
    {
        // Fetch guest cart
        $guestCart = session()->get('cart', []);
        
        // Fetch user cart from session
        $userCart = session()->get('user_cart', []);
        
        // Merge guest cart into user cart
        foreach ($guestCart as $productId => $item) {
            if (isset($userCart[$productId])) {
                $userCart[$productId]['quantity'] += $item['quantity'];
            } else {
                $userCart[$productId] = $item;
            }
        }
        
        // Save updated cart to user session and clear guest cart
        session()->put('user_cart', $userCart);
        session()->forget('cart');
    }
}
