<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class categoryController extends Controller
{
    public function categoryManage()
    {
        $categorys = Category::all();
        return view('Category.indexCategory', compact('categorys'));

    }
    public function create()
    {
        return view('Category.createCategory');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'The name field is mandatory.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not exceed 255 characters.',
            'description.string' => 'The description must be a string.',
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

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('categoryManage')->with('success', 'Category created successfully.');
    }


    public function edit($id)
    {
        $categorys = Category::findOrFail($id);
        return view('Category.editCategory', compact('categorys'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request with custom messages
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'The name field is mandatory.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not exceed 255 characters.',
            'description.string' => 'The description must be a string.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must not exceed 2MB.',
            'status.required' => 'The status field is mandatory.',
            'status.in' => 'The selected status is invalid.',
        ]);

        // Find the category by ID
        $category = Category::findOrFail($id);

        // Default to current image path if no new image is uploaded
        $imagePath = $category->image; // Keep the old image path by default
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            // Store the new image
            $path = $request->file('image')->store('images', 'public');
            $imagePath = $path; // Store the full path
        }

        // Update the category
        $category->update([
            'name' => $request->name,
            'description' => $request->description, 
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        // Redirect to a specific route with a success message
        return redirect()->route('categoryManage')->with('success', 'Category updated successfully.');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->products()->delete();
        $category->delete();
        return redirect()->route('categoryManage')->with('success deleted','Category deleted successfully.');
    }










}
