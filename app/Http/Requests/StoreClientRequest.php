<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'client_name' => 'required|string|max:50',
            'client_email' => 'nullable|email|unique:clients|required_without:client_phone',
            'client_phone' => 'nullable|string|min:11|unique:clients|required_without:client_email',
            'company_name' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'required_without' => 'Please provide at least one of :attribute.',
        ];
    }
}
