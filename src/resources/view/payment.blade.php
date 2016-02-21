<!DOCTYPE html>
<html>
<head>
    <title>Payment API</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="{{url('vendor/payment/styles.css')}}" type="text/css" rel="stylesheet">
    <script src="{{url('vendor/payment/jquery-min.js')}}" type="text/javascript"></script>
    <script src="{{url('vendor/payment/jquery.mask.js')}}" type="text/javascript"></script>
    <script src="{{url('vendor/payment/app.js')}}" type="text/javascript"></script>
</head>
<body>
<div class="container">
    <div class="content">

        {{ Form::open(['url' => '/payment-success', 'id' => 'payment-form']) }}

        <div><span class="error-curd_number error"></span></div>
        <label>Curd number</label>
        <input type="text" name="curd_number_face" value="{{ ($curd_number ? $curd_number : '') }}">
        <input type="hidden" name="curd_number" value="">
        <br>

        <div><span class="error-date error"></span></div>
        <label>Expiration date</label>
        <input type="text" name="date" value="{{ ($date ? $date : '') }}">
        <br>

        <div><span class="error-cvv2 error"></span></div>
        <label>CVV2</label>
        <input type="text" name="cvv2" maxlength="4" value="{{ ($cvv2 ? $cvv2 : '') }}">
        <br>

        <div><span class="error-email error"></span></div>
        <label>E-mail</label>
        <input type="text" name="email" value="{{ ($email ? $email : '') }}">
        <br>

        <div><span class="error-mobile error"></span></div>
        <label>Mobile Number</label>
        <input type="text" class="phone" name="mobile_face" value="">
        <input type="hidden" name="mobile" value="">
        <br>

        <button>Submit</button>
        {{ Form::close() }}
    </div>
</div>
</body>
</html>
