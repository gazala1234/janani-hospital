<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetails;
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
                'password' => Hash::make($request->password),
                // $request->password,
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

    public function login(Request $request)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        // Validate the request data
        $request->validate([
            'mobile' => 'required',
            'password' => 'required|min:6',
        ]);

        try {
            // Attempt to find the user by email
            $user = User::with('userDetails') // Assuming a 'userDetails' relationship is defined in User model
                ->where('mobile', $request->mobile)
                ->first();

            if ($user) {
                // User found, now check the password
                if (Hash::check($request->password, $user->password)) {

                    // Start session and add user details
                    session([
                        'id' => $user->id,
                        'mobile' => $user->mobile,
                        'role' => $user->role,
                        'userDetails' => $user->userDetails ? $user->userDetails->toArray() : [],
                    ]);

                    //dd(session()->all());


                    $response = [
                        'status' => true,
                        'data' => $user,
                        'message' => 'User Logged successfully',
                    ];
                    return response()->json($response, 201); // success
                } else {
                    $response = [
                        'status' => false,
                        'data' => array(),
                        'message' => 'Password incorrect.',
                    ];
                    return response()->json($response, 201); // error
                }
            } else {
                $response = [
                    'status' => false,
                    'data' => array(),
                    'message' => 'wrong credentials.',
                ];
                return response()->json($response, 201); // error
            }
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => array(),
                'message' => 'Error logging user: ' . $e->getMessage(),
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
