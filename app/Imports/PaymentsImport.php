<?php

namespace App\Imports;

use App\DTOs\PaymentDTO;
use App\Jobs\SendPaymentConfirmationEmail;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class PaymentsImport implements ToCollection
{
    protected $errors = [];
    protected $validRows = [];
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function collection(Collection $rows)
    {
        $this->validateRows($rows);

        if (!empty($this->errors)) {
            throw new ValidationException(Validator::make([], []));
        }

        $this->processValidRows();
    }

    protected function validateRows(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index === 0) {
                continue; // Skip header row
            }

            $validator = Validator::make([
                'name' => $row[0],
                'email' => $row[1],
                'amount' => $row[2],
            ], [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'amount' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                $this->errors[] = [
                    'row' => $row,
                    'errors' => $validator->errors()->all(),
                ];
            } else {
                $this->validRows[] = $row;
            }
        }
    }

    protected function processValidRows()
    {
        DB::beginTransaction();

        try {
            foreach ($this->validRows as $row) {
                $paymentDTO = new PaymentDTO($row[0], $row[1], (float) $row[2]);
                $payment = $this->paymentRepository->create($paymentDTO);

                Bus::dispatch(new SendPaymentConfirmationEmail($payment));
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}