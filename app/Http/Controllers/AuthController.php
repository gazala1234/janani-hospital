<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\validator;

class AuthController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    public function register(Request $request)
    {
        // Validate the incoming request
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 422);           
        }
        // Get the validated data
        $validatedData = $validatedData->validated();

        $user = DB::table('users')->insert([
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ]);
        if ($user) {
            return response()->json(['message' => 'Registered successfully'], 201);
        }else{
            return response()->json(['error' => 'User creation failed', 'exception' => $e->getMessage()], 500);
        }
    }


    public function login(Request $request)
    {
        // Validate the incoming request
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 422);           
        }

        $data = $validatedData->validated();

        // Attempt to find the user by email
        $user = DB::table('admin')
                    ->where('email', $data['email'])
                    ->first();

        if ($user) {
            // User found, now check password
            if ($data['password'] === $user->pass) {
                // Password is correct, log in the user
                Auth::loginUsingId($user->id);
                return response()->json(['message' => 'Logged in successfully'], 201);
            } else {
                // Password is incorrect
                return response()->json(['error' => 'Incorrect password'], 422);
            }
        } else {
            // User not found with the provided email
            return response()->json(['error' => 'User not found with provided email'], 422);
        }
    }
}
