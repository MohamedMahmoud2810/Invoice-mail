<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body>
    <p>Dear {{ $payment->name  }},</p>
    <p>We are writing to inform you that we have received your payment for the current fiscal year. The total amount received is ${{ $payment->amount }}.</p>
    <p>Thank you for your prompt payment.</p>
    <p>If you have any questions or require further clarification, please contact us.</p>
    <p>Thanks,<br>NDS</p>
</body>
</html>