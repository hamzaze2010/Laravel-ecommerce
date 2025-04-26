<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('product_id');

        // Check if user is authenticated via session or other means
        if ($request->session()->has('user_id')) {
            // User is logged in
            $userId = $request->session()->get('user_id');

            // Check if the product is already in the wishlist
            $existingWishlist = Wishlist::where('user_id', $userId)
                                        ->where('product_id', $productId)
                                        ->first();

            if ($existingWishlist) {
                return response()->json(['status' => 'error', 'message' => 'Product already in wishlist']);
            }

            // Create new wishlist entry
            $wishlist = Wishlist::create(['user_id' => $userId, 'product_id' => $productId]);

            return response()->json(['status' => 'success']);
        } else {
            // User is not logged in, store in temporary storage (cookie or session)
            $wishlistCookie = $request->cookie('wishlist_items');

            // Decrypt the cookie data if it exists
            $wishlistItems = $wishlistCookie ? json_decode(Crypt::decrypt($wishlistCookie), true) : [];

            // Check if the product is already in the temporary wishlist
            if (in_array($productId, $wishlistItems)) {
                return response()->json(['status' => 'error', 'message' => 'Product already in wishlist']);
            }

            // Add the product to the temporary wishlist
            $wishlistItems[] = $productId;

            // Encrypt and store the updated wishlist in a cookie
            $encryptedData = Crypt::encrypt(json_encode($wishlistItems));
            $cookie = Cookie::make('wishlist_items', $encryptedData, 60 * 24 * 7); // 7 days expiration

            return response()->json(['status' => 'success'])->withCookie($cookie);
        }
    }


    public function count(Request $request)
    {
        // Check if user is authenticated via session
        if ($request->session()->has('user_id')) {
            $userId = $request->session()->get('user_id');
            $count = Wishlist::where('user_id', $userId)->count();
        } else {
            // User is not logged in, retrieve the wishlist count from the cookie
            $wishlistCookie = $request->cookie('wishlist_items');

            // Decrypt the cookie data if it exists
            $wishlistItems = $wishlistCookie ? json_decode(Crypt::decrypt($wishlistCookie), true) : [];

            // Count the number of items in the temporary wishlist
            $count = count($wishlistItems);
        }

        return response()->json(['count' => $count]);
    }

    public function wishlist_page()
    {
        return view('User.wishlistpage');
    }
}
