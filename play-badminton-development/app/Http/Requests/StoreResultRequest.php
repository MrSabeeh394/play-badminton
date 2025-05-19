<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResultRequest extends FormRequest
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
            'match_id' => 'required|unique:results,match_id',
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id|different:team1_id',
            'score_team1' => 'required|integer|min:1',
            'score_team2' => 'required|integer|min:1',
            'is_final' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'match_id.required' => 'Match ID is required.',
            'match_id.unique' => 'Match ID already has a result.',
            'team1_id.required' => 'Team 1 ID is required.',
            'team1_id.exists' => 'The selected Team 1 does not exist.',
            'team2_id.required' => 'Team 2 ID is required.',
            'team2_id.exists' => 'The selected Team 2 does not exist.',
            'team2_id.different' => 'Team 2 must be different from Team 1.',
            'score_team1.required' => 'Team 1 score is required.',
            'score_team1.integer' => 'Team 1 score must be a number.',
            'score_team1.min' => 'Team 1 score must be greater than zero.',
            'score_team2.required' => 'Team 2 score is required.',
            'score_team2.integer' => 'Team 2 score must be a number.',
            'score_team2.min' => 'Team 2 score must be greater than zero.',
        ];
    }
}
