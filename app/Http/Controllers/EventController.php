<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the events with optional filtering based on query parameters.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Events::query();

        // Filter based on query parameters
        if ($request->has('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        if ($request->has('mode')) {
            $query->where('mode', $request->input('mode'));
        }
        if ($request->has('date')) {
            $query->where('date', $request->input('date'));
        }
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $events = $query->get();

        return response()->json($events);
    }

    /**
     * Store a newly created event in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $response = [
            'status' => false,
            'data' => [],
            'message' => '',
        ];

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'mode' => 'required|string',
            'address' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'img_path' => 'nullable|string'
        ]); 

        try {
            // Retrieve the user ID from the session and add it to the request data
            $userId = session('id');
            $request->merge([
                'user_id' => $userId,
                'status' => 1 
            ]);

            // Create the event detail record
            $userDetail = Events::create($request->all());

            $response['status'] = true;
            $response['data'] = $userDetail;
            $response['message'] = 'Event scheduled successfully.';
        } catch (\Exception $e) {
            $response['message'] = 'Error: ' . $e->getMessage();
        }
        return response()->json($response);
    }

    /**
     * Display the specified event.
     *
     * @param Events $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Events $event)
    {
        return response()->json($event);
    }

    /**
     * Update the specified event in storage.
     *
     * @param Request $request
     * @param Events $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Events $event)
    {
        $validatedData = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'mode' => 'sometimes|string',
            'address' => 'sometimes|string',
            'date' => 'sometimes|date',
            'start_time' => 'sometimes',
            'end_time' => 'sometimes',
            'img_path' => 'nullable|string',
            'status' => 'sometimes|integer'
        ]);

        $event->update($validatedData);

        return response()->json($event);
    }

    /**
     * Remove the specified event from storage.
     *
     * @param Events $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Events $event)
    {
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
}