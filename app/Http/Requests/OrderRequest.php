<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User  ID is required.',
            'user_id.exists' => 'The selected user does not exist.',
            'total_amount.required' => 'Total amount is required.',
            'total_amount.numeric' => 'Total amount must be a number.',
            'total_amount.min' => 'Total amount must be at least 0.',
            'products.required' => 'Products are required.',
            'products.array' => 'Products must be an array.',
            'products.*.id.required' => 'Product ID is required.',
            'products.*.id.exists' => 'The selected product does not exist.',
            'products.*.quantity.required' => 'Product quantity is required.',
            'products.*.quantity.integer' => 'Product quantity must be an integer.',
            'products.*.quantity.min' => 'Product quantity must be at least 1.',
            'shipping_address.required' => 'Shipping address is required.',
            'shipping_address.string' => 'Shipping address must be a string.',
            'payment_method.required' => 'Payment method is required.',
            'payment_method.string' => 'Payment method must be a string.',
        ];
    }
}