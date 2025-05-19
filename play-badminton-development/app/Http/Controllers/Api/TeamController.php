<?php

namespace App\Http\Controllers\Api;

use App\Models\Team;
use App\Models\PlayerTeam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::with('players')->get();
        $message = "Teams retrieved successfully";

        return response()->json([
            'message' => $message,
            'data' => $teams
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {

        $validatedData = $request->validated();

        $team = Team::create([
            'name' => $validatedData['name'],
        ]);
        return response()->json([
            'message' => 'Team created successfully!'
        ]);
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
    public function update(UpdateTeamRequest $request, string $id)
    {

        $validatedData = $request->validated();

        $team = Team::findOrFail($id);
        $team->update([
            'name' => $validatedData['name'],
        ]);

        return response()->json([
            'message' => 'Team updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json([
            'message' => 'Team deleted successfully!'
        ]);
    }
    public function availableTeams()
    {
        $bookedTeams = [];
        $teams = Team::all();
        foreach ($teams as $team) {
            $data = PlayerTeam::where('team_id', $team->id)->count();
            if ($data == 2) {
                $bookedTeams[] = $team->id;
            }
        }
        $availableTeams = Team::whereNotIn('id', $bookedTeams)->get();
        $message = "Available Teams retrieved successfully ";
        return response()->json([
            'message' => $message,
            'data' => $availableTeams
        ]);
    }
}
