<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    public function indexProduct()
    {
        $products = Product::all();
        $categories = Category::all();
        return view("Product.productManage", compact('products', 'categories'));
    }


    public function create(Request $request)
    {
        $categorys = Category::all();
        return view("Product.createProduct", compact("categorys"));
    }

    public function store(Request $request)
{
    // Validate incoming request with custom messages
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'nullable|numeric',
        'disc_price' => 'nullable|numeric',
        'quantity' => 'required|numeric',
        'category_id' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:active,inactive',
        'hot_trend' => 'nullable|boolean',
        'best_seller' => 'nullable|boolean',
        'featured' => 'nullable|boolean',
    ], [
        'name.required' => 'The name field is mandatory.',
        'name.string' => 'The name must be a string.',
        'name.max' => 'The name must not exceed 255 characters.',
        'description.string' => 'The description must be a string.',
        'price.numeric' => 'The price must be a number.',
        'disc_price.numeric' => 'The discount price must be a number.',
        'quantity.required' => 'The quantity field is mandatory.',
        'quantity.numeric' => 'The quantity must be a number.',
        'category_id.required' => 'The category field is mandatory.',
        'category_id.numeric' => 'The category ID must be a number.',
        'image.image' => 'The file must be an image.',
        'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        'image.max' => 'The image size must not exceed 2MB.',
        'status.required' => 'The status field is mandatory.',
        'status.in' => 'The selected status is invalid.',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $imagePath = $path; // Store the full path
    }

    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'disc_price' => $request->disc_price,
        'quantity' => $request->quantity,
        'category_id' => $request->category_id,
        'image' => $imagePath,
        'status' => $request->status,
        'hot_trend' => $request->boolean('hot_trend'),
        'best_seller' => $request->boolean('best_seller'),
        'featured' => $request->boolean('featured'),
    ]);

    return redirect()->route('productManage')->with('success', 'Product created successfully.');
}



    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $categorys = Category::all();
        return view('Product.editProduct', compact('products', 'categorys'));
    }

    public function update(Request $request, $id)
{
    // Validate incoming request with custom messages
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'disc_price' => 'nullable|numeric',
        'category_id' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:active,inactive',
        'hot_trend' => 'nullable|boolean',
        'best_seller' => 'nullable|boolean',
        'featured' => 'nullable|boolean',
    ], [
        'name.required' => 'The name field is mandatory.',
        'name.string' => 'The name must be a string.',
        'name.max' => 'The name must not exceed 255 characters.',
        'description.string' => 'The description must be a string.',
        'price.required' => 'The price field is mandatory.',
        'price.numeric' => 'The price must be a number.',
        'disc_price.numeric' => 'The discount price must be a number.',
        'category_id.required' => 'The category field is mandatory.',
        'category_id.numeric' => 'The category ID must be a number.',
        'image.image' => 'The file must be an image.',
        'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        'image.max' => 'The image size must not exceed 2MB.',
        'status.required' => 'The status field is mandatory.',
        'status.in' => 'The selected status is invalid.',
    ]);

    // Find the product by ID
    $product = Product::findOrFail($id);

    // Default to current image path if no new image is uploaded
    $imagePath = $product->image; // Keep the old image path by default
    if ($request->hasFile('image')) {
        // Delete the old image
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        // Store the new image
        $path = $request->file('image')->store('images', 'public');
        $imagePath = $path; // Store the full path
    }

    // Update the product
    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'disc_price' => $request->disc_price,
        'quantity' => $request->quantity,
        'category_id' => $request->category_id,
        'image' => $imagePath,
        'status' => $request->status,
        'hot_trend' => $request->boolean('hot_trend'),
        'best_seller' => $request->boolean('best_seller'),
        'featured' => $request->boolean('featured'),
    ]);

    // Redirect to a specific route with a success message
    return redirect()->route('productManage')->with('update_success', 'Product updated successfully.');
}


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('productManage')->with('success deleted','Product deleted successfully.');
    }
}
