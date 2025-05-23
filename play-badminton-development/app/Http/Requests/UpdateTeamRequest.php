<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
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
        $teamId = $this->route('team');
        return [
            'name' => 'required|string|max:255|unique:teams,name,' . $teamId,
        ];
    }
    public function messages(){
        return [
            'name.required' => 'The team name is required.',
            'name.unique' => 'This team name already exists. Please choose another.',
        ];
    }
}
