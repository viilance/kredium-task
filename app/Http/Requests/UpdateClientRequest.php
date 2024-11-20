<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $client = $this->route('client');

        return $client && $client->adviser_id === $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'nullable|email|max:150|required_without:phone',
            'phone' => 'nullable|string|max:50|required_without:email',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required_without' => 'Please provide an email address or phone number.',
            'phone.required_without' => 'Please provide a phone number or email address.',
        ];
    }
}
