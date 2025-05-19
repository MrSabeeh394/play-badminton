<?php

namespace App\Http\Controllers\Api;

use Log;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Player;
use App\Models\PlayerTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $players = Player::with(['playerTeam.team'])->get();
        $message = "Players retrieved successfully";
        return response()->json([
            'message' => $message,
            'data' => $players
        ]);
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
                'registered_with_badminton_england' => $request->has('registered_with_badminton_england') === 'yes' ? 1 : 0,
                'registration_number' => $request->has('registered_with_badminton_england') ? $validatedData['registration_number'] ?? null : null,
            ];

            if ($request->filled('picture')) {
                $base64Image = $request->input('picture');
                $imageParts = explode(';base64,', $base64Image);

                if (count($imageParts) === 2) {
                    $imageType = str_replace('data:image/', '', $imageParts[0]);
                    $decodedImage = base64_decode($imageParts[1]);
                    $fileName = time() . '.' . $imageType;

                    $path = 'players/' . $fileName;
                    Storage::disk('public')->put($path, $decodedImage);

                    $data['picture'] = $path;
                } else {
                    return response()->json(['error' => 'Invalid image format'], 400);
                }
            }

            $player = Player::create($data);

            foreach ($validatedData['team_id'] as $teamId) {
                PlayerTeam::create([
                    'player_id' => $player->id,
                    'team_id' => $teamId,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Player created successfully!',
                'player' => $player
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Player creation failed: ' . $e->getMessage());

            return response()->json([
                'error' => 'Failed to create player.',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $playerId)
    {
        $player = Player::with(['playerTeam.team'])->findOrFail($playerId);
        // Parse the player's date of birth
        $player->date_of_birth = Carbon::parse($player->date_of_birth);

        $message = "Player retrieved successfully";
        return response()->json([
            'message' => $message,
            'data' => $player
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, string $id)
    {

        $validatedData = $request->validated();
        DB::beginTransaction();
        try {
            $data = [
                'first_name' => $validatedData['first_name'],
                'surname' => $validatedData['surname'],
                'preferred_name' => $validatedData['preferred_name'] ?? null,
                'year_of_birth' => $validatedData['year_of_birth'],
                'email' => $validatedData['email'],
                'contact_number' => $validatedData['contact_number'],
                'registered_with_badminton_england' => $request->has('registered_with_badminton_england') === 'yes' ? 1 : 0,
                'registration_number' => $request->has('registered_with_badminton_england') ? $validatedData['registration_number'] ?? null : null,
            ];

            $player = Player::findOrFail($id);

            if ($request->filled('picture')) {
                $base64Image = $request->input('picture');
                $imageParts = explode(';base64,', $base64Image);

                if (count($imageParts) === 2) {
                    $imageType = str_replace('data:image/', '', $imageParts[0]);
                    $decodedImage = base64_decode($imageParts[1]);

                    $fileName = time() . '.' . $imageType;
                    $path = 'players/' . $fileName;

                    if (!empty($player->picture)) {
                        $relativePath = str_replace(Storage::disk('public')->url(''), '', $player->picture);
                        Storage::disk('public')->delete($relativePath);

                    }

                    \Storage::disk('public')->put($path, $decodedImage);

                    $data['picture'] = $path;
                } else {
                    return response()->json(['error' => 'Invalid image format'], 400);
                }
            }
            $player->update($data);
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
            $message = 'Player updated successfully';
            return response()->json([
                'message' => $message
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Player updation failed: ' . $e->getMessage());
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

        $message = 'Player deleted successfully';
        return response()->json([
            'message' => $message
        ]);
    }
}
