<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Team;
use App\Models\Matches;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $matchId)
    {
        $match = Matches::with('team1', 'team2')->findOrFail($matchId);
        return view('admin.results.add', compact('match'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResultRequest $request)
    {
        // dd($request->all());
        $validatedData = $request->validated();
        // dd($validatedData);

        $result = Result::create([
            'match_id' => $validatedData['match_id'],
            'team1_id' => $validatedData['team1_id'],
            'team2_id' => $validatedData['team2_id'],
            'score_team1' => $validatedData['score_team1'],
            'score_team2' => $validatedData['score_team2'],
            'is_final' => $validatedData['is_final'] ?? false,
        ]);

        return redirect()->route('results.show', $validatedData['match_id'])
            ->with('success', 'Result saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $matchId)
    {
        if ($matchId) {
            $result = Result::with('team1', 'team2')->where('match_id', $matchId)->first();

            if ($result) {
                return view('admin.results.index', compact('result'));
            } else {
                $message = "No result available for the given match ID.";
                return view('admin.results.index', compact('message'));
            }
        } else {
            return redirect()->back()->with('error', 'Invalid match ID provided.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $matchId)
    {

        $match = Matches::with('team1', 'team2')->findOrFail($matchId);
        $result = Result::with('team1', 'team2')->where('match_id', $matchId)->first();
        return view('admin.results.edit', compact('match', 'result'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResultRequest $request, string $id)
    {

        $validatedData = $request->validated();
        $result = Result::findOrFail($id);
        $validatedData['is_final'] = $request->has('is_final') ? 1 : 0;
        $result->update($validatedData);
        return redirect()->route('results.show', $result->match_id)->with('success', 'Result updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = Result::where('match_id', $id)->first();
        $result->delete();
        return redirect()->route('matches.index')->with('success', 'Result deleted successfully!');
    }
}
