<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CartController;

class UserController extends Controller
{
    public function user_login_page()
    {
        return view('User.loginUser');
    }
    public function user_register_page()
    {
        return view('User.registerUser');
    }

    public function home()
    {
        $users = User::all(); 
        $products = Product::all();
        $categorys = Category::all();
        return view('User.index', compact('users', 'products', 'categorys'));
    }
    

    public function indexUser()
    {
        $users = User::paginate(4);       
        return view('Admin.userManage', compact('users'));
    }

    // public function index()
    // {
    //     $users = User::all(); 
    //     $products = Product::all();
    //     $categorys = Category::all();      
    //     return view('User.index', compact('users', 'products', 'categorys'));
    // }

    public function create()
    {
        return view('Admin.createUser');
    }

    public function profileUser()
    {
        $user = Auth::guard('user')->user();
        return view('User.profile', compact('user'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'phone' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $imagePath = $path; // Store the full path
        }
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $imagePath, // Assuming 'image' is the correct field name in the users table
        ]);
    
        return redirect()->route('userLogin')->with('success', 'Registration successful. Please login.');
    }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user without using Auth facade
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                // Set user session variables
                session()->put([
                    'is_LoggedIn' => true,
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'user_image' => $user->image, 
                    'address' => $user->address,
                    'phone' => $user->phone,
                ]);
                // Merge guest cart with user cart on login
            (new CartController())->syncCartOnLogin();
                // Redirect to user dashboard
                return redirect()->route('home');
            } else {
                // Invalid password
                return redirect()->back()->withInput()->with('error', 'Invalid password');
            }
        } else {
            // Email not found
            return redirect()->back()->withInput()->with('error', 'The email address is not found');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['is_LoggedIn', 'user_id', 'user_name', 'user_email', 'user_image']);
        return redirect()->route('home');
        
    }

    public function edit()
    {
        $user = Auth::guard('user')->user();
        return view('User.edit', compact('user'));
    }

    public function editUser($id)
    {
        $users = User::findOrFail($id);
        return view('Admin.editUser', compact('users'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:3|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'The name field is mandatory.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not exceed 255 characters.',
            'email.required' => 'The email field is mandatory.',
            'email.string' => 'The email must be a string.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email must not exceed 255 characters.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is mandatory.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 3 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $imagePath = $path; // Store the full path
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
        ]);

        return redirect()->route('userManage')->with('success created', 'User created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:4|max:255',
            'password' => 'nullable|string|min:3',
            'phone' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'The name field is mandatory.',
            'name.string' => 'The name must be a string.',
            'password.min' => 'The password must be at least 3 characters long.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $user->image = $imagePath;
        }

        $user->update([
            'name' => $request->name,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $user->image,
        ]);

        return redirect()->route('userManage')->with('success update', 'User updated successfully.');
    }
    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        // Redirect to the admin management page with a success message
        return redirect()->route('userManage')->with('success deleted', 'User deleted successfully.');
    }
}
