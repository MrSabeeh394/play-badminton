<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Matches;
use App\Models\Player;
use App\Models\PlayerTeam;
use App\Models\Team;
use App\Models\Event;
use App\Models\TeamEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::with('players')->get();
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teams.add');
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
        return redirect()->route('teams.index')->with('success', 'Team created successfully!');
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
        $team = Team::findOrFail($id);

        return view('admin.teams.edit', compact('team'));
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

        return redirect()->route('teams.index')->with('success', 'Team updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */


    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }

    public function showDashboard()
    {
        $totalPlayers = Player::count();
        $totalTeams = Team::count();
        $totalEvents = Event::count();
        $totalMatches = Matches::count();
        return view('admin.dashboard', compact('totalPlayers', 'totalTeams', 'totalEvents', 'totalMatches'));
    }

}
