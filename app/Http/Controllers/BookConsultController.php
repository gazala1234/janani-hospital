<?php

namespace App\Http\Controllers;

use App\Models\BookConsult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BookConsultController extends Controller
{
    /**
     * Display a listing of the resource.
     * Allows filtering based on query parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Retrieve query parameters
        try {
            $query = BookConsult::query();

            // Apply other query string parameters dynamically
            foreach ($request->query() as $key => $value) {
                if (Schema::hasColumn('book_consult', $key)) {
                    $query->where($key, $value);
                }
            }

            $users = $query->whereNull('deleted_at')->get();

            $response = [
                'status' => true,
                'data' => $users,
                'message' => 'oppointments retrieved successfully',
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|digits_between:10,15',
            'date' => 'required|date',
            'time' => 'required',
            'query' => 'required|string',
        ]);

        try {
            // Retrieve the user ID from the session and add it to the request data
            $userId = session('id');
            $request->merge(['user_id' => $userId]);

            // Check if the user already has an appointment on the same date
            $existingAppointment = BookConsult::where('user_id', $userId)
                ->where('date', $request->date)
                ->first();

            if ($existingAppointment) {
                return response()->json([
                    'status' => false,
                    'message' => 'You already have an appointment booked on same date.',
                ], 400);
            }

            // Create the user detail record
            $userDetail = BookConsult::create($request->all());

            $response['status'] = true;
            $response['data'] = $userDetail;
            $response['message'] = 'Appointment booked successfully.';
        } catch (\Exception $e) {
            $response['message'] = 'Error: ' . $e->getMessage();
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookConsult  $bookConsult
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(BookConsult $bookConsult)
    {
        return response()->json($bookConsult);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookConsult  $bookConsult
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, BookConsult $bookConsult)
    {
        $validatedData = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|string|max:15',
            'date' => 'sometimes|date',
            'time' => 'sometimes',
            'query' => 'nullable|string',
        ]);

        $bookConsult->update($validatedData);

        return response()->json($bookConsult);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookConsult  $bookConsult
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BookConsult $bookConsult)
    {
        $bookConsult->delete();

        return response()->json(['message' => 'Record deleted successfully.'], 200);
    }
}