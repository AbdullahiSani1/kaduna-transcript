<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transcript Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-5 sm:p-8 max-w-md w-full">
        <h1 class="text-xl font-bold mb-4">Transcript Verification</h1>

        @if ($transcript)
            <div class="p-4 bg-green-50 text-green-800 rounded-md mb-4">
                ✓ This transcript is VALID
            </div>
            <div class="space-y-2 text-sm sm:text-base">
                <p><strong>Name:</strong> {{ $transcript->transcriptRequest->student->user->name }}</p>
                <p><strong>Matric Number:</strong> {{ $transcript->transcriptRequest->student->matric_number }}</p>
                <p><strong>Program:</strong> {{ $transcript->transcriptRequest->student->program->program_name }}</p>
                <p><strong>CGPA:</strong> {{ $transcript->cgpa }}</p>
                <p><strong>Classification:</strong> {{ $transcript->classification }}</p>
                <p><strong>Transcript No:</strong> {{ $transcript->transcript_number }}</p>
                <p><strong>Issued:</strong> {{ \Carbon\Carbon::parse($transcript->issued_at)->format('d M Y') }}</p>
            </div>
        @else
            <div class="p-4 bg-red-50 text-red-800 rounded-md">
                ✗ Invalid verification code. This transcript could not be found.
            </div>
        @endif
    </div>
</body>
</html>