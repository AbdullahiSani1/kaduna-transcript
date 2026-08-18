<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #15803d; color: white; padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .header h1 { margin: 0; font-size: 20px; }
        .header p { margin: 5px 0 0; font-size: 13px; opacity: 0.85; }
        .body { background: #f9f9f9; padding: 25px; border: 1px solid #ddd; }
        .info-box { background: white; padding: 15px; border-left: 4px solid #15803d; margin: 15px 0; border-radius: 0 6px 6px 0; }
        .info-box p { margin: 5px 0; font-size: 14px; }
        .btn { display: inline-block; background: #15803d; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; margin-top: 15px; font-weight: bold; }
        .footer { text-align: center; font-size: 12px; color: #888; padding: 15px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Your Transcript is Ready!</h1>
            <p>Kaduna Polytechnic — College of Science & Technology</p>
        </div>
        <div class="body">
            <p>Dear <strong>{{ $transcriptRequest->student->user->name }}</strong>,</p>
            <p>Great news! Your official academic transcript has been generated and is ready for download.</p>

            <div class="info-box">
                <p><strong>Reference Number:</strong> {{ $transcriptRequest->reference_number }}</p>
                <p><strong>Transcript Number:</strong> {{ $transcriptRequest->transcript->transcript_number }}</p>
                <p><strong>CGPA:</strong> {{ $transcriptRequest->transcript->cgpa }}</p>
                <p><strong>Classification:</strong> {{ $transcriptRequest->transcript->classification }}</p>
                <p><strong>Date Issued:</strong> {{ \Carbon\Carbon::parse($transcriptRequest->transcript->issued_at)->format('d M Y') }}</p>
            </div>

            <p>Click the button below to log in and download your transcript PDF:</p>
            <a href="{{ url('/student/transcript/requests') }}" class="btn">Download My Transcript</a>

            <p style="margin-top: 20px; font-size: 13px; color: #666;">Your transcript includes a QR code that can be scanned by employers or institutions to verify its authenticity.</p>
        </div>
        <div class="footer">
            <p><strong>Kaduna Polytechnic Transcript System</strong></p>
            <p>This is an automated message. Please do not reply.</p>
        </div>
    </div>
</body>
</html>