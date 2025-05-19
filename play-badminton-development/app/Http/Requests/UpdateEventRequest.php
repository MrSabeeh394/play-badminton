<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
        $eventId = $this->route('event');
        // dd($eventId);
        return [
            'title' => 'required|string|max:255|unique:events,title,' . $eventId,
            'level' => 'required|in:Beginner,Intermediate,Advanced',
            'team_type' => 'required|in:Single,Double',
            'max_teams' => 'required|integer|min:1|max:64',
            'points' => 'required|in:10,20,30',
            'event_type' => 'required|in:Tournament,League,Friendly,Other',
            'shuttle_type' => 'required|in:feather,nylon',
            'date' => 'required|date|after:today',
            'event_detail' => 'required|in:Double League (Feather),Double League (Nylon),Single League (Feather),Double Tournament (Cat C),Double Tournament (Cat D),Double Tournament (Open),Single Tournament (Cat C),Single Tournament (Cat D),Single Tournament (Open),Mini Tournament (Double),Mini Tournament (Single),Friendly (Single),Friendly (Double),Other',
            'location' => 'required|string|max:255',
            'team_id' => 'required|array|min:1|max:64',
            'complete_results' => 'nullable|boolean',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title is required.',
            'level.required' => 'Level is required.',
            'level.in' => 'Selected Level is invalid.',
            'team_type.required' => 'Team Type is required.',
            'team_type.in' => 'Selected Team Type is invalid.',
            'max_teams.required' => 'Max Teams is required.',
            'max_teams.integer' => 'Max Teams must be an integer.',
            'max_teams.min' => 'Max Teams must be at least 1.',
            'event_type.required' => 'Event Type is required.',
            'event_type.in' => 'Selected Event Type is invalid.',
            'shuttle_type.required' => 'Shuttle Type is required.',
            'shuttle_type.in' => 'Selected Shuttle Type is invalid.',
            'date.required' => 'Date is required.',
            'date.date' => 'Date must be a valid date.',
            'date.after' => 'Date must be a future date.',
            'event_detail.required' => 'Event Detail is required.',
            'event_detail.in' => 'Selected Event Detail is invalid.',
            'location.required' => 'Location is required.',
            'location.max' => 'Location must not exceed 255 characters.',
            'complete_results.boolean' => 'Complete Results must be true or false.',
        ];
    }
}
