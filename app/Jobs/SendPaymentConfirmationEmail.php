<?php

namespace App\Jobs;

use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPaymentConfirmationEmail implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function handle()
    {
        try {
            Log::info('Sending email to: ' . $this->payment->email);

            $pdf = $this->generatePdf();
            $this->sendEmail($pdf);

            Log::info('Email sent successfully to: ' . $this->payment->email);
        } catch (\Exception $e) {
            Log::error('Failed to send email to: ' . $this->payment->email . ' - Error: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function generatePdf()
    {
        return Pdf::loadView('invoice', ['payment' => $this->payment]);
    }

    protected function sendEmail($pdf)
    {
        Mail::send('emails.payment_confirmation', ['payment' => $this->payment], function ($message) use ($pdf) {
            $message->to($this->payment->email)
                    ->subject('Payment Confirmation')
                    ->attachData($pdf->output(), 'invoice.pdf');
        });
    }
}