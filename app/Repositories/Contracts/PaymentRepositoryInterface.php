<?php

namespace App\Repositories\Contracts;

use App\DTOs\PaymentDTO;

interface PaymentRepositoryInterface
{
    public function create(PaymentDTO $paymentDTO);
}