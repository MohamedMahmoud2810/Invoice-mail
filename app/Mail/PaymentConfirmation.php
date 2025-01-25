<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
// use PDF;

class PaymentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $amount;

    public function __construct($name, $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    public function build()
    {
        $pdf = Pdf::loadView('emails.invoice', ['name' => $this->name, 'amount' => $this->amount]);

        return $this->view('emails.payment_confirmation')
                    ->attachData($pdf->output(), 'invoice.pdf')
                    ->subject('Payment Confirmation');
    }
}
