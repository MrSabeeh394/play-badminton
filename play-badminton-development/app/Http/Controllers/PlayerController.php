<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\Player;
use App\Models\PlayerTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;


class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::all();
        foreach ($players as $player) {
            $player->relativePath = str_replace(Storage::disk('public')->url(''), '', $player->picture);
        }
        return view('admin.players.index', compact('players'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
        return view('admin.players.add', compact('availableTeams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request)
    {

        $validatedData = $request->validated();
        DB::beginTransaction();
        try {
            $data = [
                'first_name' => $validatedData['first_name'],
                'surname' => $validatedData['surname'],
                'preferred_name' => $validatedData['preferred_name'] ?? "{$validatedData['first_name']} " . strtoupper(substr($validatedData['surname'], 0, 1)) . ".",
                'year_of_birth' => $validatedData['year_of_birth'],
                'email' => $validatedData['email'],
                'contact_number' => $validatedData['contact_number'],
                'registered_with_badminton_england' => $request->has('registered_with_badminton_england') ? 1 : 0,
                'registration_number' => $request->has('registered_with_badminton_england') ? $validatedData['registration_number'] ?? null : null,
            ];
            if ($request->hasFile('picture')) {
                $fileName = time() . '.' . $request->file('picture')->getClientOriginalExtension();
                $path = $request->file('picture')->storeAs('players', $fileName, 'public');
                $data['picture'] = $path;
            }
            $player = Player::create($data);
            foreach ($validatedData['team_id'] as $teamId) {
                PlayerTeam::create([
                    'player_id' => $player->id,
                    'team_id' => $teamId,
                ]);
            }
            DB::commit();
            return redirect()->route('players.index')->with('success', 'Player created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Player creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create player.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $playerId)
    {
        $playerTeam = PlayerTeam::with('team')->where('player_id', $playerId)->first();
        $player = Player::findOrFail($playerId);
        $player->date_of_birth = Carbon::parse($player->date_of_birth);
        // $relativePath = str_replace(Storage::disk('public')->url(''), '', $player->picture);

        return view('admin.players.show', compact('player', 'playerTeam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $playerId)
    {
        $selectedTeams = PlayerTeam::where('player_id', $playerId)->pluck('team_id')->toArray();
        $player = Player::findOrFail($playerId);

        // Determine booked teams (teams with 2 players already assigned)
        $bookedTeams = [];
        $teams = Team::all();

        foreach ($teams as $team) {
            $data = PlayerTeam::where('team_id', $team->id)->count();
            if ($data == 2) {
                $bookedTeams[] = $team->id;
            }
        }

        // Get teams that are not fully booked
        $availableTeams = Team::whereNotIn('id', $bookedTeams)->get();

        $teams = Team::all();

        return view('admin.players.edit', compact('player', 'availableTeams', 'selectedTeams', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $player = Player::findOrFail($id);
        DB::beginTransaction();
        try {

            if ($request->hasFile('picture')) {

                if ($player->picture) {
                    $oldImagePath = $player->picture;
                    if (\Storage::disk('public')->exists($oldImagePath)) {
                        \Storage::disk('public')->delete($oldImagePath);
                    }

                }

                $fileName = time() . '.' . $request->file('picture')->getClientOriginalExtension();
                $path = $request->file('picture')->storeAs('players', $fileName, 'public');

                $validatedData['picture'] = 'players/' . $fileName;
                $player->picture = $validatedData['picture'];
            }
            $player->update([
                'first_name' => $validatedData['first_name'],
                'surname' => $validatedData['surname'],
                'preferred_name' => $validatedData['preferred_name'],
                'year_of_birth' => $validatedData['year_of_birth'],
                'email' => $validatedData['email'],
                'contact_number' => $validatedData['contact_number'],
                'picture' => $validatedData['picture'] ?? $player->picture,
                'registered_with_badminton_england' => $request->has('registered_with_badminton_england') ? 1 : 0,
                'registration_number' => $request->has('registered_with_badminton_england')
                    ? ($validatedData['registration_number'] ?? null)
                    : null,
            ]);

            foreach ($validatedData['team_id'] as $teamId) {
                PlayerTeam::updateOrCreate(
                    [
                        'player_id' => $player->id,
                        'team_id' => $teamId,
                    ],
                    [
                        'player_id' => $player->id,
                        'team_id' => $teamId,
                    ]
                );
            }
            DB::commit();
            return redirect()->route('players.index')->with('success', 'Player updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Player updation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update player.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $player = Player::findOrFail($id);
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player deleted successfully!');
    }
}
