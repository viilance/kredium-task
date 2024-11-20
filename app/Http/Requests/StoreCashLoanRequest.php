<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreCashLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @throws ValidationException
     */
    public function authorize(): bool
    {
        $client = $this->route('client');

        if ($client->adviser_id !== $this->user()->id) {
            return false;
        }

        if ($client->cashLoan) {
            $validator = validator([], []);
            $validator->errors()->add('loan', 'This client already has a Cash Loan.');
            throw new ValidationException($validator);
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'loan_amount' => 'required|numeric|min:0',
        ];
    }
}
