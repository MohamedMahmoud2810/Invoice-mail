<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header img {
            max-width: 150px; /* Adjust the logo size */
            margin-bottom: 10px;
        }
        .invoice-header h1 {
            font-size: 24px;
            color: #007bff;
            margin: 0;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details p {
            margin: 5px 0;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #f5f5f5;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Invoice Header with Logo -->
        <div class="invoice-header">
            <img src="{{ public_path('images/logo.png') }}" alt="Company Logo">
            <h1>Invoice</h1>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
            <p><strong>Name:</strong> {{ $payment->name }}</p>
            <p><strong>Email:</strong> {{ $payment->email }}</p>
            <p><strong>Date:</strong> {{ now()->format('Y-m-d') }}</p>
        </div>

        <!-- Invoice Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Payment for the current fiscal year</td>
                    <td>${{ $payment->amount }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Invoice Footer -->
        <div class="invoice-footer">
            <p>Thank you for your prompt payment.</p>
            <p>If you have any questions or require further clarification, please contact us.</p>
            <p>Thanks,<br>NDS</p>
        </div>
    </div>
</body>
</html>