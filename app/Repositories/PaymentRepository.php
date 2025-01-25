<?php

namespace App\Repositories;

use App\DTOs\PaymentDTO;
use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function create(PaymentDTO $paymentDTO)
    {
        return Payment::create([
            'name' => $paymentDTO->name,
            'email' => $paymentDTO->email,
            'amount' => $paymentDTO->amount,
        ]);
    }
}