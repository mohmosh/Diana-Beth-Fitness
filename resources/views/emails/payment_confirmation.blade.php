<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body>
    <h2>Dear {{ $name }},</h2>

    <p>We are pleased to inform you that your payment has been successfully received. Here are your payment details:</p>

    <ul>
        <li><strong>Amount Paid:</strong> {{ $amount }}</li>
        <li><strong>Plan:</strong> {{ $plan }}</li>
        <li><strong>Date Paid:</strong> {{ $datePaid }}</li>
    </ul>

    <p>Thank you for subscribing to the <strong>{{ $plan }}</strong> plan. You now have access to exclusive workouts and resources tailored for your fitness journey.</p>

    <p>If you have any questions, feel free to reach out to us.</p>

    <p>Best regards,</p>
    <p><strong>Diana Beth Fitness Team</strong></p>
</body>
</html>

