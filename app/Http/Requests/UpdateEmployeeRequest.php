<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->user->id,
             
            'phone' => 'nullable|string|min:11|unique:users,phone,'.$this->user->id,

            'employee_id' => 'required|string|unique:userinfos,employee_id,'.$this->user->userinfo->id, 

            'nid_passport' => 'required|string|unique:userinfos,nid_passport,'.$this->user->userinfo->id,

            'status' => 'required|in:Active,Inactive',

            'department_id' => 'required|integer',
            'designation_id' => 'required|integer',
            'joining_date' => 'required|date|date_format:Y-m-d',

        ];
    }
}
