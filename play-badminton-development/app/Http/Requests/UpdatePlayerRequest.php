<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PlayerTeam;
use App\Models\Team;

class UpdatePlayerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('player');

        // Fetch existing selected teams for the player
        $existingTeamIds = PlayerTeam::where('player_id', $id)->pluck('team_id')->toArray();

        return [
            'first_name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'preferred_name' => 'nullable|string|max:255|unique:players,preferred_name,' . $id,
            'team_id' => [
                'required',
                'array',
                'min:1',
                'max:64',
                function ($attribute, $values, $fail) use ($existingTeamIds) {
                    foreach ($values as $value) {
                        // Skip validation for existing teams
                        if (in_array($value, $existingTeamIds)) {
                            continue;
                        }

                        // Validate only new team selections
                        $team = Team::withCount('players')->find($value);
                        if (!$team) {
                            $fail("The selected team with ID {$value} does not exist.");
                        } elseif ($team->players_count >= 2) {
                            $fail("The team with ID {$value} already has the maximum of two players.");
                        }
                    }
                },
            ],
            'team_id.*' => 'required|exists:teams,id',
            'year_of_birth' => 'required|date|before:today',
            'email' => 'required|email|max:255|unique:players,email,' . $id,
            'contact_number' => 'required|numeric|digits_between:10,15',
            'registered_with_badminton_england' => 'nullable|boolean',
            'registration_number' => 'integer|' . ($this->input('registered_with_badminton_england') == 1 ? 'required' : 'nullable'),
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required.',
            'team_id.required' => 'The selected team already has the maximum of two players.',
            'surname.required' => 'Surname is required.',
            'year_of_birth.required' => 'Year of Birth is required.',
            'year_of_birth.before' => 'Year of Birth must be a past date.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already registered.',
            'contact_number.required' => 'Contact Number is required.',
            'contact_number.numeric' => 'Contact Number must be a valid number.',
            'contact_number.digits_between' => 'Contact Number must be between 10 and 15 digits.',
            'registration_number.required_if' => 'Registration Number is required if registered with Badminton England.',
        ];
    }
}