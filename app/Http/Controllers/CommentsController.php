<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Comments::query();

            // Apply other query string parameters dynamically
            foreach ($request->query() as $key => $value) {
                if (Schema::hasColumn('comments', $key)) {
                    $query->where($key, $value);
                }
            }

            $comments = $query->whereNull('deleted_at')->get();

            $response = [
                'status' => true,
                'data' => $comments,
                'message' => 'comments retrieved successfully',
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

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
            'path' => 'nullable|string',
            'comments_count' => 'nullable|integer',
            'likes_count' => 'nullable|integer',
        ]);

        try {
            $comment = Comments::create($validatedData);

            $response = [
                'status' => true,
                'data' => $comment,
                'message' => 'Comment added successfully.',
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
     * Display the specified comment.
     */
    public function show($id)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        try {
            $comment = Comments::findOrFail($id);

            $response = [
                'status' => true,
                'data' => $comment,
                'message' => 'Comment retrieved successfully.',
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
     * Update the specified comment in storage.
     */
    public function update(Request $request, $id)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        try {
            $comment = Comments::findOrFail($id);

            $validatedData = $request->validate([
                'content' => 'string',
                'path' => 'nullable|string',
                'comments_count' => 'nullable|integer',
                'likes_count' => 'nullable|integer',
            ]);

            $comment->update($validatedData);

            $response = [
                'status' => true,
                'data' => $comment,
                'message' => 'Comment updated successfully.',
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
     * Remove the specified comment from storage (soft delete).
     */
    public function destroy($id)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        try {
            $comment = Comments::findOrFail($id);
            $comment->delete();

            $response = [
                'status' => true,
                'data' => $comment,
                'message' => 'Comment deleted successfully.',
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
