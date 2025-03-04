<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body>
    <h2>Hello {{ $name }},</h2>

    <p>Thank you for subscribing to the <strong>{{ $plan }}</strong> plan!</p>

    <p>Your payment of <strong>KES {{ number_format($amount, 2) }}</strong> was successful.</p>

    <p>Enjoy your workouts and stay fit!</p>

    <p>Best regards,</p>
    <p><strong>Diana Beth Fitness Team</strong></p>
</body>
</html>
