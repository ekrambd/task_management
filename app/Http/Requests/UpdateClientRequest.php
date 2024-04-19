<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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

            'client_email' => 'nullable|email|required_without:client_phone|unique:clients,client_email,'.$this->client->id,

            'client_phone' => 'nullable|string|min:11|required_without:client_email|unique:clients,client_phone,'.$this->client->id,


            'company_name' => 'required|string|max:50',
        ];
    }
}
