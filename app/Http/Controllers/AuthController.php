<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        try {
            $query = User::query();

            // Apply other query string parameters dynamically
            foreach ($request->query() as $key => $value) {
                if (Schema::hasColumn('users', $key)) {
                    $query->where($key, $value);
                }
            }

            $users = $query->whereNull('deleted_at')->get();

            $response = [
                'status' => true,
                'data' => $users,
                'message' => 'user logged in successfully',
            ];

            // Return success response
            return response()->json($response, 200);
        } catch (\Exception $e) {
            // Return error response in case of exception
            $response = [
                'status' => false,
                'data' => array(),
                'message' => 'An error occurred while: ' . $e->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }


    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $response = array(
            'status' => false,
            'data' => array(),
            'message' => '',
        );

        // Validate the request data
        $request->validate([
            'mobile' => 'required|digits_between:10,15|unique:users,mobile',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|string|max:50',
        ]);

        try {
            // Create and save the user
            $user = User::create([
                'mobile' => $request->mobile,
                'password' => $request->password,
                // Hash::make($request->password),
                'role' => $request->role,
            ]);

            // Return response with status, data, and message
            $response = [
                'status' => true,
                'data' => $user,
                'message' => 'Account created successfully',
            ];
            return response()->json($response, 201); // Created
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => array(),
                'message' => 'Error creating account: ' . $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }

    // public function login(Request $request)
    // {
    //     // Initialize response array
    //     $response = array(
    //         'status' => false,
    //         'data' => array(),
    //         'message' => '',
    //     );

    //     // Validate the request data
    //     $request->validate([
    //         'mobile' => 'required|digits_between:10,15',
    //         'password' => 'required|min:6',
    //     ]);


    //     try {
    //         if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
    //             // Authentication passed
    //             $user = Auth::user();

    //             $response = [
    //                 'status' => true,
    //                 'data' => $user,
    //                 'message' => 'Login successful',
    //             ];

    //             // Optionally, you can create a session or a token for API authentication
    //             // For example: 
    //             // $token = $user->createToken('YourAppName')->plainTextToken;

    //             return response()->json($response, 200); // OK
    //         } else {
    //             // Authentication failed
    //             $response = [
    //                 'status' => false,
    //                 'data' => array(),
    //                 'message' => 'Invalid mobile number or password.',
    //             ];
    //             return response()->json($response, 401); // Unauthorized
    //         }
    //     } catch (\Exception $e) {
    //         $response = [
    //             'status' => false,
    //             'data' => array(),
    //             'message' => 'Error creating user: ' . $e->getMessage(),
    //         ];
    //         return response()->json($response, 500);
    //     }
    // }

    public function auth_login(Request $request)
    {
        // Initialize response array
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        // Validate the request data
        $request->validate([
            'mobile' => 'required|digits_between:10,15',
            'password' => 'required|min:6',
        ]);

        try {
            // Retrieve user by mobile
            $user = User::where('mobile', $request->mobile)->first();

            if ($user && $user->password === $request->password) {
                // Authentication passed
                Auth::login($user); // Log the user in

                $response = [
                    'status' => true,
                    'data' => $user,
                    'message' => 'Login successful',
                ];

                return response()->json($response, 200); // OK
            } else {
                // Authentication failed
                $response = [
                    'status' => false,
                    'data' => [],
                    'message' => 'Invalid mobile number or password.',
                ];
                return response()->json($response, 401); // Unauthorized
            }
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => [],
                'message' => 'Error creating user: ' . $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }


    public function logout()
    {
        auth()->logout();
        $response = array(
            'status' => true,
            'message' => 'logout successfully',
            'data' => array(),
        );
        return response()->json($response, 200);
    }
}