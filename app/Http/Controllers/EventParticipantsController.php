<?php

namespace App\Http\Controllers;

use App\Models\EventParticipants;
use Illuminate\Http\Request;

class EventParticipantsController extends Controller
{
    /**
     * Display a listing of the event participants with optional filtering based on query parameters.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = EventParticipants::query();

        // Apply filters based on query parameters
        if ($request->has('event_id')) {
            $query->where('event_id', $request->input('event_id'));
        }
        if ($request->has('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        $participants = $query->get();

        return response()->json($participants);
    }

    /**
     * Store a newly created event participant in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $participant = EventParticipants::create($validatedData);

        return response()->json($participant, 201);
    }

    /**
     * Display the specified event participant.
     *
     * @param EventParticipants $eventParticipant
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(EventParticipants $eventParticipant)
    {
        return response()->json($eventParticipant);
    }

    /**
     * Update the specified event participant in storage.
     *
     * @param Request $request
     * @param EventParticipants $eventParticipant
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, EventParticipants $eventParticipant)
    {
        $validatedData = $request->validate([
            'event_id' => 'sometimes|exists:events,id',
            'user_id' => 'sometimes|exists:users,id'
        ]);

        $eventParticipant->update($validatedData);

        return response()->json($eventParticipant);
    }

    /**
     * Remove the specified event participant from storage.
     *
     * @param EventParticipants $eventParticipant
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(EventParticipants $eventParticipant)
    {
        $eventParticipant->delete();

        return response()->json(['message' => 'Event participant deleted successfully']);
    }
}