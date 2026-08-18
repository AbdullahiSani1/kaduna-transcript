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
        .footer { text-align: center; font-size: 12px; color: #888; padding: 15px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Transcript Request Update</h1>
            <p>Kaduna Polytechnic — College of Science & Technology</p>
        </div>
        <div class="body">
            <p>Dear <strong>{{ $transcriptRequest->student->user->name }}</strong>,</p>
            <p>Your transcript request status has been updated. Please see the details below:</p>

            <div class="info-box">
                <p><strong>Reference Number:</strong> {{ $transcriptRequest->reference_number }}</p>
                <p><strong>New Status:</strong> {{ str_replace('_', ' ', ucfirst($transcriptRequest->status)) }}</p>
                @if ($transcriptRequest->admin_remarks)
                    <p><strong>Admin Remarks:</strong> {{ $transcriptRequest->admin_remarks }}</p>
                @endif
            </div>

            <p>Please log in to your account to view full details of your request.</p>
        </div>
        <div class="footer">
            <p><strong>Kaduna Polytechnic Transcript System</strong></p>
            <p>This is an automated message. Please do not reply.</p>
        </div>
    </div>
</body>
</html>