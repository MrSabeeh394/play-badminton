<?php

namespace App\Http\Controllers;

use App\Models\EventTeam;
use App\Models\PlayerTeam;
use App\Models\Team;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function getTeams($teamType)
    {
        // Fetch teams based on player count
        $playerCount = $teamType === 'Single' ? 1 : 2;
        $teams = Team::withCount('players')
            ->having('players_count', '=', $playerCount)
            ->get();

        // Return teams as JSON
        return response()->json($teams);
    }
    public function getTeamsByTeamType($teamType)
    {
        $validTeamType = ['single', 'double'];
        if ($teamType == 'single') {
            $singleTeams = [];
            $teams = Team::all();
            foreach ($teams as $team) {
                $data = PlayerTeam::where('team_id', $team->id)->count();
                if ($data == 1) {
                    $singleTeams[] = $team->id;
                }
            }

            $avaialbleTeams = Team::whereIn('id', $singleTeams)->get();

            return response()->json([
                'status' => true,
                $data => $avaialbleTeams
            ], 200);

            // dd($avaialbleTeams);

        } else if ($teamType == 'double') {
            $doubleTeams = [];
            $teams = Team::all();
            foreach ($teams as $team) {
                $data = PlayerTeam::where('team_id', $team->id)->count();
                if ($data == 2) {
                    $doubleTeams[] = $team->id;
                }
            }
            $avaialbleTeams = Team::whereIn('id', $doubleTeams)->get();

            return response()->json([
                'status' => true,
                $data => $avaialbleTeams
            ], 200);


        } else {
            dd("Invalid Team Types");
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // $teams = Team::all();
        $teams = Team::withCount('players')->get();
        // dd($teams);
        return view('admin.events.add', compact('teams'));

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

            return redirect()->route('events.index')->with('success', 'Event created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Event creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create event.');
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teams = Team::all();
        $selectedTeams = EventTeam::where('event_id', $id)->pluck('team_id')->toArray();
        // dd($selectedTeams);
        $event = Event::findOrFail($id);

        return view('admin.events.edit', compact('event', 'selectedTeams', 'teams'));
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
                    [
                        'team_id' => $teamId,
                        'event_id' => $event->id,
                    ],
                    [
                        'team_id' => $teamId,
                        'event_id' => $event->id,
                    ]
                );
            }

            DB::commit();

            return redirect()->route('events.index')->with('success', 'Event updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Event update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update the event.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}

