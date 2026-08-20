<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 4px; }
        table.results { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        table.results th, table.results td { border: 1px solid #333; padding: 5px; text-align: left; font-size: 11px; }
        .session-title { font-weight: bold; margin-top: 15px; margin-bottom: 5px; }
        .footer { margin-top: 30px; display: flex; justify-content: space-between; align-items: center; }
        .cgpa-box { text-align: center; margin-top: 20px; font-weight: bold; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <table width="100%">
            <tr>
                <td width="15%" style="vertical-align: middle;">
                    <img src="{{ public_path('images/KADPOLY_LOGO.jpg') }}" width="80" height="80" style="object-fit: contain;">
                </td>
                <td width="70%" style="vertical-align: middle; text-align: center;">
                    <h1 style="margin: 0; font-size: 24px;">KADUNA POLYTECHNIC</h1>
                    <p style="margin: 4px 0 0;">OFFICIAL ACADEMIC TRANSCRIPT</p>
                    <p style="margin: 2px 0 0; font-size: 11px;">College of Science and Technology</p>
                </td>
                <td width="15%" style="vertical-align: middle; text-align: right;">
                    <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" width="80" height="80">
                </td>
            </tr>
        </table>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Name:</strong> {{ $student->user->name }}</td>
            <td><strong>Matric Number:</strong> {{ $student->matric_number }}</td>
        </tr>
        <tr>
            <td><strong>Program:</strong> {{ $student->program->program_name }}</td>
            <td><strong>Transcript No:</strong> {{ $transcript->transcript_number }}</td>
        </tr>
        <tr>
            <td><strong>Admission Year:</strong> {{ $student->admission_year }}</td>
            <td><strong>Issue Date:</strong> {{ \Carbon\Carbon::parse($transcript->issue_date ?? now())->format('M d, Y') }}</td>
        </tr>
    </table>

    @foreach ($results as $sessionLabel => $courses)
        <div class="session-title">{{ $sessionLabel }}</div>
        <table class="results">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Units</th>
                    <th>Score</th>
                    <th>Grade</th>
                    <th>Grade Point</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $result)
                    <tr>
                        <td>{{ $result->course->course_code }}</td>
                        <td>{{ $result->course->course_title }}</td>
                        <td>{{ $result->course->credit_unit }}</td>
                        <td>{{ $result->score }}</td>
                        <td>{{ $result->grade }}</td>
                        <td>{{ $result->grade_point }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <div class="cgpa-box">
        Cumulative GPA: {{ $cgpa }} | Classification: {{ $classification }}
    </div>

    <div class="footer" style="margin-top: 30px; border-top: 2px solid #333; padding-top: 15px;">
        <table width="100%">
            <tr>
                <td style="font-size: 11px; color: #333;">
                    <p style="margin: 0;"><strong>Transcript No:</strong> {{ $transcript->transcript_number }}</p>
                    <p style="margin: 4px 0 0;"><strong>Verification Code:</strong> {{ $transcript->verification_code }}</p>
                    <p style="margin: 8px 0 0; color: #555;">To verify the authenticity of this transcript, visit:</p>
                    <p style="margin: 2px 0 0; color: #15803d;"><strong>{{ url('/verify/' . $transcript->verification_code) }}</strong></p>
                    <p style="margin: 4px 0 0; color: #555; font-size: 10px;">Or scan the QR code at the top right corner of this document.</p>
                </td>
                <td style="text-align: right; font-size: 11px; color: #333;">
                    <p style="margin: 0;">Issued: {{ $transcript->issued_at ? \Carbon\Carbon::parse($transcript->issued_at)->format('d M Y') : 'N/A' }}</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>