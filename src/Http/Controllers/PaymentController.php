<?php

namespace Ivanchenko\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PaymentController extends Controller
{

    /**
     * Convert currencies handler
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $curd_number = $request->request->get('curd_number', '');
        $cvv2 = $request->request->get('cvv2', '');
        $email = $request->request->get('email', '');
        $mobile = $request->request->get('mobile', '');
        $date = $request->request->get('date', '');

        return view('payment::payment', [
            'curd_number' => $curd_number,
            'cvv2' => $cvv2,
            'email' => $email,
            'mobile' => $mobile,
            'date' => $date,
        ]);
    }
}