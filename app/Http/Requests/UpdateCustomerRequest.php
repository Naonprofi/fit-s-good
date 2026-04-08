<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('update', Customer::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $customerId = $this->route('customersApi');

        $customer = Customer::find($customerId);

        if (! $customer) {
            return ['error' => 'required'];
        }

        $userId = $customer->user_id;

        return [
            'name' => 'sometimes|required',
            'age' => 'sometimes|required|integer',
            'gender' => 'sometimes|required',
            'phone' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users,email,'.$userId,
            'password' => 'sometimes|nullable|min:8',
            'mem_type' => 'in:none,premium',
        ];
    }
}
