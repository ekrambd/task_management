<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|min:11|unique:users',
            'status' => 'required|in:Active,Inactive',
            'employee_id' => 'required|string|unique:userinfos',
            'nid_passport' => 'nullable|string|unique:userinfos',
            'department_id' => 'required|integer',
            'designation_id' => 'required|integer',
            'joining_date' => 'required|date|date_format:Y-m-d',
        ];
    }
}
