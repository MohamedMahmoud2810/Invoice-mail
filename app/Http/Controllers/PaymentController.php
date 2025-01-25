<?php

namespace App\Http\Controllers;

use App\Facades\PaymentFacade;
use App\Http\Requests\ImportPaymentRequest;
use Illuminate\Http\Request;
use App\Imports\PaymentsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Payment;
use App\Jobs\SendPaymentConfirmationEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Bus;

class PaymentController extends Controller
{
    public function import(ImportPaymentRequest $request): JsonResponse
    {
        $result = PaymentFacade::import($request->file('file'));

        if (!empty($result['errors'])) {
            return response()->json([
                'message' => $result['message'],
                'errors' => $result['errors'],
            ], 422); // 422 Unprocessable Entity
        }

        return response()->json(['message' => $result['message']]);
    }
}
