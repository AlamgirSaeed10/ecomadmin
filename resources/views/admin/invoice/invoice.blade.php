
<!DOCTYPE html>
<html>
<head>
    <title>Invoice Receipt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .receipt-info {
            margin-bottom: 20px;
        }
        .receipt-info p {
            margin: 5px 0;
        }
        .receipt-table {
            margin-bottom: 30px;
        }
        .receipt-table th,
        .receipt-table td {
            padding: 10px;
            border: 1px solid #dee2e6;
        }
        .total-amount {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invoice Receipt</h1>

        <div class="receipt-info">
            <p><strong>Enrollment ID:</strong> {{ $enrollments[0]->EnrollmentID }}</p>
            <p><strong>Student Name:</strong> {{ $enrollments[0]->StudentName }}</p>
            <p><strong>Payment Date:</strong> {{ $enrollments[0]->PaymentDate }}</p>
        </div>

        <table class="table receipt-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount (PKR)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Course Fee</td>
                    <td>00</td>
                </tr>
                <tr>
                    <td>Additional Charges</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td><strong>Total Amount</strong></td>
                    <td class="total-amount">00</td>
                </tr>
            </tbody>
        </table>

        <p>Thank you for your payment. Please keep this receipt for your reference.</p>
    </div>
</body>
</html>
