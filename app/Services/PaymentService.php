<?php

namespace App\Services;

use App\DTOs\PaymentDTO;
use App\Jobs\SendPaymentConfirmationEmail;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Services\Contracts\PaymentServiceInterface;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PaymentsImport;

class PaymentService implements PaymentServiceInterface
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function import($file)
    {
        $paymentsImport = new PaymentsImport($this->paymentRepository);

        try {
            Excel::import($paymentsImport, $file);

            return [
                'message' => 'Payments imported and emails dispatched successfully!',
                'errors' => [],
            ];
        } catch (\Exception $e) {
            $errors = $paymentsImport->getErrors();

            if (!empty($errors)) {
                return [
                    'message' => 'Import failed due to validation errors.',
                    'errors' => $errors,
                ];
            }

            return [
                'message' => 'Import failed: ' . $e->getMessage(),
                'errors' => [],
            ];
        }
    }
}