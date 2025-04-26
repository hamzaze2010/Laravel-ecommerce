<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        $totalAdmins = $admins->count();
        $categorys = Category::all();
        $totalCategorys = $categorys->count();
        $products = Product::all();
        $totalProducts = $categorys->count();
        $users = User::all();
        $totalUsers = $users->count();
        return view('Admin.index', compact('totalAdmins','totalProducts', 'totalCategorys', 'totalUsers', 'admins', 'categorys', 'products', 'users'));
    }
    public function admin_default_page()
    {
        return view('Admin.adminLogin');
    }
    public function singUp(){

        return view('Admin.adminsign_up');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admins = Admin::where('email', $request->email)->first();

        if ($admins) {
            if (Hash::check($request->password, $admins->password)) {
                session()->put([
                    'isLoggedIn' => true,
                    'admin_id' => $admins->id,
                    'admin_name' => $admins->name,
                    'admin_image' => $admins->image_path,
                ]);


                return redirect()->route('Adminindex');
            } else {
                return redirect()->back()->withInput()->with('error', 'Invalid password');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'The email address is not found ');
        }
    }
    
    public function logout(Request $request)
    {
        $request->session()->forget(['isLoggedIn', 'admin_id', 'admin_name', 'admin_image']);
        return redirect()->route('admin_default_page');
        
    }

    public function adminManage()
    {
        $admins = Admin::all();
        return view('Admin.adminManage', compact('admins'));
    }
    

    /**
     * Show the form for creating a new resource. 
     */
    public function create()
    {
        return view('Admin.createAdmin'); 
    }


    /**
     * Store a newly created resource in storage. 
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4|max:255',
            'email' => 'required|string|email|max:255|unique:admin',
            'password' => 'required|string|min:3|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'required|string',
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
            'gender.required' => 'Please select a gender.',
            'gender.string' => 'The gender must be a string.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $imagePath = $path; // Store the full path
        }

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image_path' => $imagePath,
            'Gender' => $request->gender,
        ]);

        return redirect()->route('adminManage')->with('success', 'Admin created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    public function profileAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        return view('Admin.adminProfile', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admins = Admin::findOrFail($id);
        return view('Admin.editAdmin', compact('admins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|min:5|max:40',
            'password' => 'nullable|string|min:3', // Make password nullable to allow for updating without changing password
            'gender' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow for updating without changing image
        ], [
            'name.required' => 'The name field is mandatory.',
            'password.min' => 'The password must be at least 3 characters long.',
            'gender.required' => 'Please select a gender.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);

        // Find the admin record
        $admin = Admin::findOrFail($id);

        // Update the admin record with the new data
        $admin->name = $request->name;
        // Check if password field is filled
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }
        $admin->Gender = $request->gender;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('admin/img', 'public');
            $admin->image_path = $imagePath;
        }
        $admin->save();

        // Update session data if the logged-in admin is the one being updated
        if (session('admin_id') == $id) {
            session()->put([
                'admin_name' => $admin->name,
                'admin_image' => $admin->image_path,
                'admin_gender' => $admin->Gender,
            ]);
        }

        // Redirect with success message
        return redirect()->route('adminManage')->with('update_success', 'Admin updated successfully.');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        // Redirect to the admin management page with a success message
        return redirect()->route('adminManage')->with('success deleted', 'Admin deleted successfully.');
    }
    
}

