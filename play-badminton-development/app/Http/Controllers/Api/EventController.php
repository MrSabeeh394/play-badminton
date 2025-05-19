<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Models\EventTeam;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('teams')->get();

        $message = "Events retrieved successfully";
        return response()->json([
            'message' => $message,
            'data' => $events
        ]);
    }

    public function getTeams(Request $request)
    {
        // Fetch teams based on player count
        $type = $request->input('type');

        if ($type == 'single') {
            $teams = Team::withCount('players')
                ->having('players_count', '=', 1)
                ->get();
        } elseif ($type == 'double') {
            $teams = Team::withCount('players')
                ->having('players_count', '=', 2)
                ->get();
        } else {
            // If no type is specified, fetch all teams
            $teams = Team::withCount('players')->get();
        }

        return response()->json($teams);
    }


    /**
     * Store a newly created resource in storage.
     */


    public function store(StoreEventRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {
            $event = Event::create([
                'title' => $validatedData['title'],
                'level' => $validatedData['level'],
                'team_type' => $validatedData['team_type'],
                'max_teams' => $validatedData['max_teams'],
                'points' => $validatedData['points'],
                'event_type' => $validatedData['event_type'],
                'shuttle_type' => $validatedData['shuttle_type'],
                'date' => $validatedData['date'],
                'event_detail' => $validatedData['event_detail'],
                'location' => $validatedData['location'],
                'complete_results' => $validatedData['complete_results'] ?? false,
            ]);

            foreach ($validatedData['team_id'] as $teamId) {
                EventTeam::create([
                    'team_id' => $teamId,
                    'event_id' => $event->id,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Event created successfully'

            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Event creation failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to create event.',
                'error' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, string $id)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $event = Event::findOrFail($id);

            $completeResults = $validatedData['complete_results'] ?? false;
            $event->update([
                'title' => $validatedData['title'],
                'level' => $validatedData['level'],
                'team_type' => $validatedData['team_type'],
                'max_teams' => $validatedData['max_teams'],
                'points' => $validatedData['points'],
                'event_type' => $validatedData['event_type'],
                'shuttle_type' => $validatedData['shuttle_type'],
                'date' => $validatedData['date'],
                'event_detail' => $validatedData['event_detail'],
                'location' => $validatedData['location'],
                'complete_results' => $completeResults,
            ]);

            $currentTeamIds = EventTeam::where('event_id', $event->id)->pluck('team_id')->toArray();
            $teamIdsToRemove = array_diff($currentTeamIds, $validatedData['team_id']);

            EventTeam::where('event_id', $event->id)
                ->whereIn('team_id', $teamIdsToRemove)
                ->delete();

            foreach ($validatedData['team_id'] as $teamId) {
                EventTeam::updateOrCreate(
                    ['team_id' => $teamId, 'event_id' => $event->id],
                    ['team_id' => $teamId, 'event_id' => $event->id]
                );
            }

            DB::commit();

            return response()->json([
                'message' => 'Event updated successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Event update failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to update event.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json([
            'message' => 'Event deleted successfully'
        ]);

    }
}
