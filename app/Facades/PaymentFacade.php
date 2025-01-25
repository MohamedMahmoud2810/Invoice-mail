<?php

namespace App\Facades;

use App\Services\Contracts\PaymentServiceInterface;
use Illuminate\Support\Facades\Facade;

class PaymentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PaymentServiceInterface::class;
    }
}