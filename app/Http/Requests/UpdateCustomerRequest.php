<?php

namespace App\Http\Requests;

use App\Models\Customer;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // 1. Megnézzük, mi jön az URL-ből (customersApi/{id})
        $customerId = $this->route('customersApi');

        // 2. Megkeressük a Customer-t
        $customer = Customer::find($customerId);

        // 3. Ha nincs meg, ne is menjen tovább a validáció
        if (! $customer) {
            return ['error' => 'required'];
        }

        $userId = $customer->user_id;

        return [
            'name' => 'sometimes|required',
            'age' => 'sometimes|required|integer',
            'gender' => 'sometimes|required',
            'phone' => 'sometimes|required',
            // Itt a legfontosabb rész:
            'email' => 'sometimes|required|email|unique:users,email,'.$userId,
            'password' => 'sometimes|nullable|min:8',
        ];
    }
}
