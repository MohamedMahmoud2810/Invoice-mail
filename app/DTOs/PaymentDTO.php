<?php

namespace App\DTOs;

class PaymentDTO
{
    public string $name;
    public string $email;
    public float $amount;

    public function __construct(string $name, string $email, float $amount)
    {
        $this->name = $name;
        $this->email = $email;
        $this->amount = $amount;
    }
}