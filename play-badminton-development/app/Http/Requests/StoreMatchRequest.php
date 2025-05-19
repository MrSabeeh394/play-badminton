<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatchRequest extends FormRequest
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
            'event_id' => 'required|exists:events,id',
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id|different:team1_id',
            'type' => 'required|in:Group,Knockout',
            'sets' => 'required|in:Single,Best of 3',
            'setting' => 'sometimes|boolean',
        ];
    }
    public function messages()
    {
        return [
            'team2_id.different' => 'Team 2 must be different from Team 1.',
            'event_id.required' => 'The event ID is required.',
            'event_id.exists' => 'The selected event does not exist.',
            'team1_id.required' => 'Team 1 ID is required.',
            'team1_id.exists' => 'The selected Team 1 does not exist.',
            'team2_id.required' => 'Team 2 ID is required.',
            'team2_id.exists' => 'The selected Team 2 does not exist.',
            'type.required' => 'Match type is required.',
            'type.in' => 'Match type must be either Group or Knockout.',
            'sets.required' => 'Sets information is required.',
            'sets.in' => 'Sets must be Single or Best of 3.',
            'setting.boolean' => 'Setting must be true or false.',
        ];
    }
}
