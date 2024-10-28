<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Posts::with(['user.userDetails','comments.user.userDetails']);

            // Apply other query string parameters dynamically
            foreach ($request->query() as $key => $value) {
                if (Schema::hasColumn('posts', $key)) {
                    $query->where($key, $value);
                }
            }

            $posts = $query->whereNull('deleted_at')->get();

            $response = [
                'status' => true,
                'data' => $posts,
                'message' => 'posts retrieved successfully',
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'path' => 'nullable|string',
            'type' => 'nullable|string',
            'comments_count' => 'nullable|integer',
            'likes_count' => 'nullable|integer',
        ]);

        try {
            $post = Posts::create($validatedData);

            $response = [
                'status' => true,
                'data' => $post,
                'message' => 'Post created successfully.',
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
     * Display the specified post.
     */
    public function show($id)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        try {
            $post = Posts::findOrFail($id);

            $response = [
                'status' => true,
                'data' => $post,
                'message' => 'Post retrieved successfully.',
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
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        try {
            $post = Posts::findOrFail($id);

            $validatedData = $request->validate([
                // 'title' => 'nullable|string|max:255',
                // 'content' => 'nullable|string',
                // 'path' => 'nullable|string',
                // 'type' => 'nullable|string',
                // 'comments_count' => 'nullable|integer',
                'likes_count' => 'nullable|integer',
            ]);

            $post->update($validatedData);

            $response = [
                'status' => true,
                'data' => $post,
                'message' => 'Post updated successfully.',
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
     * Remove the specified post from storage (soft delete).
     */
    public function destroy($id)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        try {
            $post = Posts::findOrFail($id);
            $post->delete();

            $response = [
                'status' => true,
                'data' => $post,
                'message' => 'Post deleted successfully.',
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

    public function like($id)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];
    
        try {
            // Find the post by ID
            $post = Posts::findOrFail($id);
            $userId = Auth::id(); // Get the currently authenticated user's ID
    
            // Decode the liked_by JSON field into an array
            $likedBy = json_decode($post->user_id, true) ?? [];
    
            // Check if the user has already liked the post
            if (in_array($userId, $likedBy)) {
                $response['message'] = 'You have already liked this post.';
                return response()->json($response, 403); // Forbidden
            }
    
            // If not already liked, increment likes_count and add userId to liked_by array
            $post->increment('likes_count');
            $likedBy[] = $userId;
            $post->liked_by = json_encode($likedBy); // Update liked_by field
            $post->save();
    
            $response = [
                'status' => true,
                'data' => $post,
                'message' => 'Post liked successfully.',
            ];
            return response()->json($response, 201); // success
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => [],
                'message' => 'Error occurred while liking the post: ' . $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }
    
}
