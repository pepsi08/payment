<?php
namespace Ivanchenko\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest {

    public function rules()
    {
        return [
            'cvv2' => ['required','regex:/^[0-9]{3,4}$/'],
            'mobile-h' => 'required',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'cvv2.regex' => 'CVV2 has to be 3-4 numbers',
            'email.email' => 'Fill correct email address',
        ];
    }

    public function authorize()
    {
        return true;
    }

}