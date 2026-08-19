<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - KadPoly Transcript System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4', 100: '#dcfce7', 200: '#bbf7d0',
                            300: '#86efac', 400: '#4ade80', 500: '#22c55e',
                            600: '#16a34a', 700: '#15803d', 800: '#166534', 900: '#14532d',
                        },
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-lg p-5 sm:p-8 max-w-md w-full mx-4">

        <div class="flex items-center gap-3 mb-6">
            <img src="/images/KADPOLY_LOGO.jpg" alt="KadPoly Logo" class="w-12 h-12 object-contain">
            <div>
                <h1 class="font-bold text-lg text-primary-700">KadPoly Transcript</h1>
                <p class="text-gray-500 text-sm">Payment Portal</p>
            </div>
        </div>

        <div class="bg-gray-50 rounded-xl p-4 mb-6 space-y-2 border border-gray-200">
            <p class="text-sm"><span class="font-medium text-gray-600">Reference Number:</span> <span class="text-gray-800">{{ $transcriptRequest->reference_number }}</span></p>
            <p class="text-sm"><span class="font-medium text-gray-600">Purpose:</span> <span class="text-gray-800">{{ str_replace('_', ' ', ucfirst($transcriptRequest->purpose)) }}</span></p>
            <p class="text-sm"><span class="font-medium text-gray-600">Student:</span> <span class="text-gray-800">{{ $transcriptRequest->student->user->name }}</span></p>
            <p class="text-sm"><span class="font-medium text-gray-600">Email:</span> <span class="text-gray-800">{{ $transcriptRequest->student->user->email }}</span></p>

            <div class="border-t border-gray-200 pt-2 mt-2">
                <p class="text-sm"><span class="font-medium text-gray-600">Amount:</span>
                    <span class="text-xl font-bold text-primary-700">₦{{ number_format($transcriptRequest->payment->amount, 2) }}</span>
                </p>
            </div>
        </div>

        @if ($transcriptRequest->payment->status === 'pending')
            <button onclick="payWithPaystack()" style="background-color: #16a34a;"
                class="w-full text-white font-semibold py-3 rounded-xl hover:opacity-90 transition text-base">
                Pay Now with Paystack
            </button>

            <p class="text-center text-xs text-gray-400 mt-3">Secured by Paystack. Your payment is safe.</p>

        @else
            <div class="p-4 bg-green-50 text-green-800 rounded-xl text-center">
                <p class="font-semibold">Payment Already Confirmed</p>
                <p class="text-sm mt-1">Paid on {{ \Carbon\Carbon::parse($transcriptRequest->payment->paid_at)->format('d M Y, h:i A') }}</p>
            </div>
        @endif

        <div class="mt-4 text-center">
            <a href="{{ route('student.transcript.requests') }}" class="text-sm text-primary-600 hover:underline">Back to My Requests</a>
        </div>
    </div>

    <script>
        function payWithPaystack() {
            var handler = PaystackPop.setup({
                key: '{{ config("paystack.public_key") }}',
                email: '{{ $transcriptRequest->student->user->email }}',
                amount: {{ $transcriptRequest->payment->amount * 100 }},
                currency: 'NGN',
                ref: '{{ $transcriptRequest->reference_number }}',
                metadata: {
                    transcript_request_id: {{ $transcriptRequest->id }},
                },
                callback: function(response) {
                    // Send reference to backend for verification
                    window.location.href = '/student/transcript/{{ $transcriptRequest->id }}/verify-payment?reference=' + response.reference;
                },
                onClose: function() {
                    alert('Payment cancelled. You can try again.');
                }
            });
            handler.openIframe();
        }
    </script>

</body>
</html>