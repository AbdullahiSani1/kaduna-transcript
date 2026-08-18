<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #15803d; color: white; padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .header img { width: 60px; height: 60px; object-fit: contain; border-radius: 50%; background: white; padding: 5px; margin-bottom: 10px; }
        .header h1 { margin: 0; font-size: 20px; }
        .header p { margin: 5px 0 0; font-size: 13px; opacity: 0.85; }
        .body { background: #f9f9f9; padding: 25px; border: 1px solid #ddd; }
        .info-box { background: white; padding: 15px; border-left: 4px solid #15803d; margin: 15px 0; border-radius: 0 6px 6px 0; }
        .info-box p { margin: 5px 0; font-size: 14px; }
        .footer { text-align: center; font-size: 12px; color: #888; padding: 15px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Transcript Request Received</h1>
            <p>Kaduna Polytechnic — College of Science & Technology</p>
        </div>
        <div class="body">
            <p>Dear <strong>{{ $transcriptRequest->student->user->name }}</strong>,</p>
            <p>Your transcript request has been received successfully. Below are your request details:</p>

            <div class="info-box">
                <p><strong>Reference Number:</strong> {{ $transcriptRequest->reference_number }}</p>
                <p><strong>Purpose:</strong> {{ str_replace('_', ' ', ucfirst($transcriptRequest->purpose)) }}</p>
                <p><strong>Amount Due:</strong> ₦{{ number_format($transcriptRequest->payment->amount, 2) }}</p>
                <p><strong>RRR (Remita Retrieval Reference):</strong> {{ $transcriptRequest->payment->remita_rrr }}</p>
                <p><strong>Status:</strong> Pending Payment</p>
            </div>

            <p>Please proceed to complete your payment using the RRR above. Your request will be processed after payment confirmation.</p>
            <p>You can log in to your account at any time to track your request status.</p>
        </div>
        <div class="footer">
            <p><strong>Kaduna Polytechnic Transcript System</strong></p>
            <p>This is an automated message. Please do not reply.</p>
        </div>
    </div>
</body>
</html>