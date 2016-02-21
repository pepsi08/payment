<?php

namespace Ivanchenko\Payment;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Validator;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        Validator::extend('luhn', function (
            $attribute,
            $value,
            $parameters,
            $validator
        ) {
            /** @var \Illuminate\Validation\Validator $validator */
            $validator->setCustomMessages(['luhn' => 'Card number is invalid.']);
            if($value == 0){
                return false;
            }
            // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
            $value = preg_replace('/\D/', '', $value);
            // Set the string length and parity
            $number_length = strlen($value);
            $parity = $number_length % 2;
            // Loop through each digit and do the maths
            $total = 0;
            for ($i = 0; $i < $number_length; $i++) {
                $digit = $value[$i];
                // Multiply alternate digits by two
                if ($i % 2 == $parity) {
                    $digit *= 2;
                    // If the sum is two digits, add them together (in effect)
                    if ($digit > 9) {
                        $digit -= 9;
                    }
                }
                // Total up the digits
                $total += $digit;
            }
            // If the total mod 10 equals 0, the number is valid
            return ($total % 10 === 0);
        });

        $this->loadViewsFrom(__DIR__ . '/resources/view', 'payment');

        $this->publishes([
            __DIR__ . '/resources/view' => resource_path('views/vendor/payment'),
        ]);

        $this->publishes([
            __DIR__ . '/js' => public_path('vendor/payment'),
            __DIR__ . '/css' => public_path('vendor/payment'),
        ], 'public');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }
        $this->app->make('Ivanchenko\Payment\Http\Controllers\PaymentController');
        $this->app->make('Ivanchenko\Payment\Http\Controllers\PaymentValidationController');
    }
}

