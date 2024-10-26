<?php

namespace App\Http\Controllers;

use App\Models\Replies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Replies::query();

            // Apply other query string parameters dynamically
            foreach ($request->query() as $key => $value) {
                if (Schema::hasColumn('replies', $key)) {
                    $query->where($key, $value);
                }
            }

            $replies = $query->whereNull('deleted_at')->get();

            $response = [
                'status' => true,
                'data' => $replies,
                'message' => 'replies retrieved successfully',
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = array(
            'status' => false,
            'data' => array(),
            'message' => '',
        );

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'comment_id' => 'required|exists:comments,id',
            'content' => 'required|string',
            'path' => 'nullable|string',
            'replies_count' => 'nullable|integer',
            'likes_count' => 'nullable|integer',
        ]);

        try {
            $reply = Replies::create($validatedData);

            $response = [
                'status' => true,
                'data' => $reply,
                'message' => 'Reply added successfully.',
            ];
            return response()->json($response, 201); // success
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => array(),
                'message' => 'Error occured while: ' . $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Display the specified reply.
     */
    public function show($id)
    {

        $response = array(
            'status' => false,
            'data' => array(),
            'message' => '',
        );

        try {
            $reply = Replies::findOrFail($id);

            $response = [
                'status' => true,
                'data' => $reply,
                'message' => 'Reply retrieved successfully.',
            ];
            return response()->json($response, 201); // success
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => array(),
                'message' => 'Error occured while: ' . $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified reply in storage.
     */
    public function update(Request $request, $id)
    {
        $response = array(
            'status' => false,
            'data' => array(),
            'message' => '',
        );

        try {
            $reply = Replies::findOrFail($id);

            $validatedData = $request->validate([
                'content' => 'string',
                'path' => 'nullable|string',
                'replies_count' => 'nullable|integer',
                'likes_count' => 'nullable|integer',
            ]);

            $reply->update($validatedData);

            $response = [
                'status' => true,
                'data' => $reply,
                'message' => 'Reply updated successfully.',
            ];
            return response()->json($response, 201); // success
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => array(),
                'message' => 'Error occured while: ' . $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified reply from storage (soft delete).
     */
    public function destroy($id)
    {
        $response = array(
            'status' => false,
            'data' => array(),
            'message' => '',
        );

        try {
            $reply = Replies::findOrFail($id);
            $reply->delete();

            $response = [
                'status' => true,
                'data' => $reply,
                'message' => 'Reply deleted successfully.',
            ];
            return response()->json($response, 201); // success
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => array(),
                'message' => 'Error occured while: ' . $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }
}
