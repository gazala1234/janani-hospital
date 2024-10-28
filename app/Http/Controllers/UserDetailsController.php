<?php

namespace App\Http\Controllers;

use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = UserDetails::query();

            // Apply other query string parameters dynamically
            foreach ($request->query() as $key => $value) {
                if (Schema::hasColumn('user_details', $key)) {
                    $query->where($key, $value);
                }
            }

            $users = $query->whereNull('deleted_at')->get();

            $response = [
                'status' => true,
                'data' => $users,
                'message' => 'user retrieved successfully',
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

    public function store(Request $request)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        // Validate the request
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'email|unique:user_details,email',
            'country' => 'string|max:255',
            'dob' => 'required|date',
            'mobile' => 'required|digits_between:10,15|unique:user_details,mobile',
            'blood_group' => 'required|string|max:10',
            'address' => 'string',
            'img_path' => 'nullable|string'
        ]);

        try {
            // Retrieve the user ID from the session and add it to the request data
            $userId = session('id');
            $request->merge(['user_id' => $userId]);

            // Create the user detail record
            $userDetail = UserDetails::create($request->all());

            $response['status'] = true;
            $response['data'] = $userDetail;
            $response['message'] = 'User detail added successfully.';
        } catch (\Exception $e) {
            $response['message'] = 'Error adding user detail: ' . $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * Display the specified user detail.
     */
    public function show($id)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        try {
            $userDetail = UserDetails::findOrFail($id);

            $response['status'] = true;
            $response['data'] = $userDetail;
            $response['message'] = 'User detail retrieved successfully.';
        } catch (\Exception $e) {
            $response['message'] = 'Error retrieving user detail: ' . $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * Update the specified user detail.
     */
    public function update(Request $request, $id)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        // Validate the request
        $request->validate([
            'fname' => 'sometimes|string|max:255',
            'lname' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'user_id' => 'sometimes|exists:users,id',
            'email' => 'sometimes|email|unique:user_details,email,' . $id,
            'country' => 'sometimes|string|max:255',
            'dob' => 'sometimes|date',
            'mobile' => 'sometimes|digits_between:10,15|unique:user_details,mobile,' . $id,
            'blood_group' => 'sometimes|string|max:10',
            'address' => 'sometimes|string',
            'img_path' => 'nullable|string',
        ]);

        try {
            $userDetail = UserDetails::findOrFail($id);
            $userDetail->update($request->all());

            $response['status'] = true;
            $response['data'] = $userDetail;
            $response['message'] = 'User detail updated successfully.';
        } catch (\Exception $e) {
            $response['message'] = 'Error updating user detail: ' . $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * Remove the specified user detail.
     */
    public function destroy($id)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        try {
            $userDetail = UserDetails::findOrFail($id);
            $userDetail->delete();

            $response['status'] = true;
            $response['message'] = 'User detail deleted successfully.';
        } catch (\Exception $e) {
            $response['message'] = 'Error deleting user detail: ' . $e->getMessage();
        }

        return response()->json($response);
    }
}