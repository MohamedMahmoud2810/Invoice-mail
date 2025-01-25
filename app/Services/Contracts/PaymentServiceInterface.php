<?php

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface PaymentServiceInterface
{
    public function import(UploadedFile $file);
}