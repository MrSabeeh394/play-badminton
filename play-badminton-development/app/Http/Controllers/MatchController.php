<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
use App\Models\Matches;
use App\Models\Team;
use App\Models\Event;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matches = Matches::with(['event', 'team1', 'team2'])->get();

        return view('admin.matches.index', compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all();
        $teams = Team::all();
        return view('admin.matches.add', compact('events', 'teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMatchRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['setting'] = $request->has('setting') ? 1 : 0;

        $match = Matches::create($validatedData);

        return redirect()->route('matches.index')->with('success', 'Match created successfully.');
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
        $match = Matches::with(['event', 'team1', 'team2'])->find($id);
        $events = Event::all();
        $teams = Team::all();
        return view('admin.matches.edit', compact('match', 'events', 'teams'));
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
        return redirect()->route('matches.index')->with('success', 'Match updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $match = Matches::findOrFail($id);
        $match->delete();

        return redirect()->route('matches.index')->with('success', 'Match deleted successfully!');
    }
}
