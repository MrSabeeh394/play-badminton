<?php

namespace App\Http\Controllers\Api;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResultRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['match_id'] = $request->match_id;
        $validatedData['team1_id'] = $request->team1_id;
        $validatedData['team2_id'] = $request->team2_id;

        $result = Result::create($validatedData);
        return response()->json([
            'message' => 'Result created successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $matchId)
    {
        if ($matchId) {
            $result = Result::with('team1', 'team2')->where('match_id', $matchId)->first();

            if ($result) {
                return response()->json([
                    'message' => 'Result retrieved successfully',
                    'data' => $result
                ]);

            } else {

                $message = "No result available for the given match ID.";
                return response()->json([
                    'message' => $message
                ]);
            }
        } else {
            return response()->json([
                'error' => 'Invalid match ID provided.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResultRequest $request, string $id)
    {

        $validatedData = $request->validated();
        $result = Result::where('match_id', $request->match_id)->first();
        $result->update($validatedData);
        return response()->json([
            'message' => 'Result updated successfully!'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $matchId)
    {
        $result = Result::where('match_id', $matchId)->first();
        $result->delete();
        return response()->json([
            'message' => 'Result deleted successfully!'
        ]);
        // return redirect()->route('matches.index')->with('success', 'Result deleted successfully!');
    }
}
