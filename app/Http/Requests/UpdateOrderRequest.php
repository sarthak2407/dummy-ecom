<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => 'in:pending,processing,completed,cancelled',
            'shipping_address' => 'string',
            'payment_method' => 'string'
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'The status must be one of the following: pending, processing, completed, cancelled.',
            'shipping_address.string' => 'Shipping address must be a string.',
            'payment_method.string' => 'Payment method must be a string.',
        ];
    }
}