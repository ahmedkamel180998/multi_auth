<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f6f6f6; padding: 20px;">
<div style="max-width: 600px; background: white; padding: 20px; border-radius: 10px; margin: auto;">
    <h2 style="color: #333;">Hello, {{ $user->name }} 👋</h2>
    <p>We received a request to reset your password.</p>
    <p>
        <a href="{{ $url }}"
           style="background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">
            Reset Password
        </a>
    </p>
    <p>This link will expire in 60 minutes.</p>
    <p>If you didn’t request this, you can ignore this email.</p>
    <p style="color: #555;">Best regards,<br>Multi Auth Team</p>
</div>
</body>
</html>
