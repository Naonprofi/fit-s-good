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
        $customer = $this->route('customer');
        if (! $customer) {
            $customer = Customer::where('user_id', auth()->id())->first();
        }

        return $customer && auth()->id() === $customer->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cust_name' => 'required|string|max:255',
            'cust_email' => 'required|email|max:255',
            'cust_phone_num' => 'required|string|max:20',
            'cust_gender' => 'required|in:male,female,other',
            'cust_age' => 'required|integer|min:0|max:120',
        ];
    }
}
