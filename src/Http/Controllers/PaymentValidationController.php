<?php

namespace Ivanchenko\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class PaymentValidationController extends Controller
{

    /**
     * Payment Request Validation
     *
     * @param Request $request
     * @return $this
     */
    public function validatePaymentData(Request $request)
    {

        $v = Validator::make($request->all(), [
            'cvv2' => ['required', 'regex:/^[0-9]{3,4}$/'],
            'email' => 'required|email',
            'curd_number' => 'luhn|alpha_num|required',
            'mobile' => 'phone:UA,mobile|required',
            'date' => 'required|date_format:Y/m/d|after:today',
        ], [
            'curd_number.alpha_num' => 'Card number should be numeric.',
            'mobile.phone' => 'Mobile is not valid',
            'date.after' => 'Date has to be present or future',
        ]);

        if ($v->fails()) {
            return response($v->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return json_encode(true);
    }
}