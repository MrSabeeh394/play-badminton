<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
use App\Models\Team;
use App\Models\Event;
use App\Models\Matches;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matches = Matches::with(['event', 'team1', 'team2'])->get();
        $message = "Matches retrieved successfully";
        return response()->json([
            'message' => $message,
            'data' => $matches
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMatchRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['setting'] = $request->has('setting') ? 1 : 0;

        $match = Matches::create($validatedData);

        return response()->json([
            'message' => 'Match created successfully.'
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $match = Matches::with(['event', 'team1', 'team2'])->find($id);
        return response()->json([
            'message' => 'Match retrieved successfully.',
            'data' => $match
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMatchRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $validatedData['setting'] = $request->has('setting') ? 1 : 0;

        $match = Matches::findOrFail($id);
        $match->update([
            'event_id' => $validatedData['event_id'],
            'team1_id' => $validatedData['team1_id'],
            'team2_id' => $validatedData['team2_id'],
            'type' => $validatedData['type'],
            'sets' => $validatedData['sets'],
            'setting' => $validated['setting'] ?? false,
        ]);
        return response()->json([
            'message' => 'Match updated successfully!'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $match = Matches::findOrFail($id);
        $match->delete();
        return response()->json([
            'message' => 'Match deleted successfully.'
        ]);
    }
}
