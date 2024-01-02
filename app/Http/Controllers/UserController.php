<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
    public function show($id)
    {
        return User::find($id);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'f_name' => 'required|string|max:255',
                'l_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|max:12|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
    
            // Create a new User instance
            $user = new User();
    
            // Set user attributes

            $user->f_name = Str::ucfirst($request->input('f_name'));
            $user->l_name = Str::ucfirst($request->input('l_name'));

            $user->email = $request->input('email');
    
            // Hash the password
            $user->password = md5(env('APP_SECRET') . $request->input('password'));
    
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = 'user_' . $user->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $user->img = 'images/' . $imageName;
            } 

            $user->save();

            return response()->json($user, 201);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'f_name' => 'string|max:255',
                'l_name' => 'string|max:255',
                'email' => 'email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8|max:12|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Find the user by ID
            $user = User::findOrFail($id);
    
            // Update user attributes
            $user->f_name = $request->filled('f_name') ? Str::ucfirst($request->input('f_name')) : $user->f_name;
            $user->l_name = $request->filled('l_name') ? Str::ucfirst($request->input('l_name')) : $user->l_name;
            $user->email = $request->filled('email') ? $request->input('email') : $user->email;

            if ($request->has('password')) {
                // Update the password only if provided
                $user->password = sha1(env('APP_SECRET') . $request->input('password'));
            }
            
            // Update the image if provided
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = 'user_' . $user->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $user->img = 'images/' . $imageName;
            }
    
             // Log or dd statements for debugging
        Log::info('Request data: ' . json_encode($request->f_name));
        Log::info('User ID: ' . $id);
            // Save the user
            $user->save();
    
            return response()->json($user, 200);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return 204;
    }
}
