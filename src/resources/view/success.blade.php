<!DOCTYPE html>
<html>
<head>
    <title>Currency Converter</title>
</head>
<body>
<div class="container">
    <div class="content">

        @if($success)
            <div class="payment">
                <h3>Payment is done successfully</h3>
                <a href="{{url('/')}}">
                    <strong>Go back</strong>
                </a>
            </div>
        @endif

    </div>
</div>
</body>
</html>
