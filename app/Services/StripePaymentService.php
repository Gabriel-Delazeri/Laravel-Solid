<?php

namespace App\Services;

class StripePaymentService
{
    public function process($total)
    {
        $price = "£{$total}";
        return 'Processing payment of ' . $price . ' through Stripe';
    }
}
