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
            $query = Posts::with(['user.userDetails', 'comments.user.userDetails']);

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
            $post = Posts::findOrFail($id);
            $userId = session('id');  // Retrieve user ID from session
    
            if (!$userId) {
                return response()->json(['status' => false, 'message' => 'User not authenticated'], 401);
            }
    
            if ($post->likedBy($userId)) {
                // If user already liked the post, unlike it
                $post->likes()->where('user_id', $userId)->delete();
    
                // Decrement the likes_count column
                $post->decrement('likes_count');
    
                $response['message'] = 'Post unliked successfully.';
            } else {
                // If not already liked, create a like
                $post->likes()->create(['user_id' => $userId]);
    
                // Increment the likes_count column
                $post->increment('likes_count');
    
                $response['message'] = 'Post liked successfully.';
            }
    
            $response['status'] = true;
            $response['data'] = ['likes_count' => $post->likes_count];  // Return updated likes_count directly
    
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => [],
                'message' => 'Error occurred: ' . $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }
    
    
}
