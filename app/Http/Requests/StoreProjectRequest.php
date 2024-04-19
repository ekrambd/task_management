<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project_name' => 'required|string|max:50|unique:projects',
            'category_id' => 'required|integer',
            'department_id' => 'required|integer',
            'client_id' => 'required|integer',
            'project_priority' => 'required|in:Low,Medium,High',
            'start_date' => 'required',
            'end_date' => 'required',
            'duration' => 'required|numeric',
            'duration_unit' => 'required|in:Day,Month,Week,Year',
            'project_cost' => 'required|numeric',
            'status' => 'required|in:Pending,Confirm,On going,Completed,Finished,Cancel',
        ];
    }
}
