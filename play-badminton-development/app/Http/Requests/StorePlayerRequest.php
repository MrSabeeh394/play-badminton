<?php

namespace App\Http\Requests;

use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'preferred_name' => 'nullable|string|max:255|unique:players,preferred_name',
            'team_id' => [
                'required',
                'array',
                'min:1',
                'max:64',
                function ($attribute, $values, $fail) {
                    foreach ($values as $value) {
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
            'email' => 'required|email|max:255|unique:players,email',
            'contact_number' => 'required|numeric|digits_between:10,15',
            'picture' => 'nullable',
            'registered_with_badminton_england' => 'nullable|boolean',
            'registration_number' => 'nullable|string|max:255|required_if:registered_with_badminton_england,true',
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required.',
            'surname.required' => 'Surname is required.',
            'team_id.required' => 'The selected team already has the maximum of two players.',
            'year_of_birth.required' => 'Year of Birth is required.',
            'year_of_birth.before' => 'Year of Birth must be a past date.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already registered.',
            'contact_number.required' => 'Contact Number is required.',
            'contact_number.numeric' => 'Contact Number must be a valid number.',
            'contact_number.digits_between' => 'Contact Number must be between 10 and 15 digits.',
            'picture.image' => 'Profile Picture must be an image.',
            'picture.mimes' => 'Profile Picture must be a file of type: jpeg, png, jpg, gif.',
            'picture.max' => 'Profile Picture size must not exceed 2MB.',
            'registration_number.required_if' => 'Registration Number is required if registered with Badminton England.',
        ];
    }
}
