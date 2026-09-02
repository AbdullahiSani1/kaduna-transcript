<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transcript Request Details
            </h2>
            <a href="{{ route('admin.transcript-requests.index') }}" class="text-sm text-primary-600 hover:underline">
                ← Back to All Requests
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 bg-green-50 text-green-800 rounded-xl border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Status Banner --}}
            @php
                $statusColors = [
                    'pending' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-800', 'border' => 'border-yellow-200', 'badge' => 'bg-yellow-100 text-yellow-800'],
                    'payment_confirmed' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-800', 'border' => 'border-blue-200', 'badge' => 'bg-blue-100 text-blue-800'],
                    'processing' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-800', 'border' => 'border-purple-200', 'badge' => 'bg-purple-100 text-purple-800'],
                    'ready' => ['bg' => 'bg-green-50', 'text' => 'text-green-800', 'border' => 'border-green-200', 'badge' => 'bg-green-100 text-green-800'],
                    'completed' => ['bg' => 'bg-green-50', 'text' => 'text-green-800', 'border' => 'border-green-200', 'badge' => 'bg-green-100 text-green-800'],
                    'rejected' => ['bg' => 'bg-red-50', 'text' => 'text-red-800', 'border' => 'border-red-200', 'badge' => 'bg-red-100 text-red-800'],
                ];
                $color = $statusColors[$transcriptRequest->status] ?? $statusColors['pending'];
            @endphp

            <div class="{{ $color['bg'] }} border {{ $color['border'] }} sm:rounded-2xl p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold {{ $color['text'] }} uppercase tracking-wide">Current Status</p>
                    <p class="text-2xl font-bold {{ $color['text'] }} mt-1">{{ str_replace('_', ' ', ucfirst($transcriptRequest->status)) }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $color['badge'] }} break-all">
                    Ref: {{ $transcriptRequest->reference_number }}
                </span>
            </div>

            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Student Info --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Student Information
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500">Full Name</p>
                            <p class="text-sm font-medium text-gray-800">{{ $transcriptRequest->student->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Matric Number</p>
                            <p class="text-sm font-medium text-gray-800">{{ $transcriptRequest->student->matric_number }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Program</p>
                            <p class="text-sm font-medium text-gray-800">{{ $transcriptRequest->student->program->program_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Email</p>
                            <p class="text-sm font-medium text-gray-800">{{ $transcriptRequest->student->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Admission Year</p>
                            <p class="text-sm font-medium text-gray-800">{{ $transcriptRequest->student->admission_year }}</p>
                        </div>
                    </div>
                </div>

                {{-- Request Info --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Request Information
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500">Reference Number</p>
                            <p class="text-sm font-medium text-gray-800">{{ $transcriptRequest->reference_number }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Purpose</p>
                            <p class="text-sm font-medium text-gray-800">{{ str_replace('_', ' ', ucfirst($transcriptRequest->purpose)) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Destination Address</p>
                            <p class="text-sm font-medium text-gray-800">{{ $transcriptRequest->destination_address ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Date Submitted</p>
                            <p class="text-sm font-medium text-gray-800">{{ $transcriptRequest->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        @if ($transcriptRequest->admin_remarks)
                            <div>
                                <p class="text-xs text-gray-500">Admin Remarks</p>
                                <p class="text-sm font-medium text-gray-800">{{ $transcriptRequest->admin_remarks }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Payment Info --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Payment Information
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-gray-500">Amount</p>
                            <p class="text-2xl font-bold text-primary-700">₦{{ number_format($transcriptRequest->payment->amount ?? 0, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Payment Status</p>
                            <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                                {{ $transcriptRequest->payment->status === 'successful' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($transcriptRequest->payment->status ?? 'N/A') }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Reference</p>
                            <p class="text-sm font-medium text-gray-800">{{ $transcriptRequest->payment->remita_rrr ?? 'N/A' }}</p>
                        </div>
                        @if ($transcriptRequest->payment->paid_at)
                            <div>
                                <p class="text-xs text-gray-500">Paid On</p>
                                <p class="text-sm font-medium text-gray-800">{{ \Carbon\Carbon::parse($transcriptRequest->payment->paid_at)->format('d M Y, h:i A') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Update Status --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Update Request Status
                </h3>

                <form method="POST" action="{{ route('admin.transcript-requests.update-status', $transcriptRequest->id) }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">New Status</label>
                        {{-- Restricted to the three manual application stages. 'payment_confirmed' is
                             set automatically by the payment flow; 'ready' and 'rejected' are left in
                             the DB enum but not exposed here for now. --}}
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                            @foreach (['pending', 'processing', 'completed'] as $status)
                                <option value="{{ $status }}" {{ $transcriptRequest->status === $status ? 'selected' : '' }}>
                                    {{ str_replace('_', ' ', ucfirst($status)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Admin Remarks (optional)</label>
                        <input type="text" name="admin_remarks" value="{{ $transcriptRequest->admin_remarks }}"
                            placeholder="Add a note for the student..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div class="sm:col-span-3">
                        <button type="submit" style="background-color: #16a34a;" class="text-white font-semibold px-6 py-2.5 rounded-lg hover:opacity-90 transition text-sm">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>

            {{-- Transcript Generation — disabled for now (application-only workflow).
                 Admin processes the transcript manually outside the system.
                 The original PDF/QR generation block is preserved below in a Blade
                 comment so it can be restored later without rebuilding it. --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Transcript Document
                </h3>

                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                    <p class="text-sm font-semibold text-gray-700">Processed manually</p>
                    <p class="text-xs text-gray-500 mt-1">
                        This application is handled outside the system for now. Update the status above to reflect progress.
                    </p>
                </div>

                {{--
                @if ($transcriptRequest->transcript)
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-green-800">Transcript Generated</p>
                            <p class="text-xs text-green-600 mt-1">
                                {{ $transcriptRequest->transcript->transcript_number }} |
                                CGPA: {{ $transcriptRequest->transcript->cgpa }} |
                                {{ $transcriptRequest->transcript->classification }}
                            </p>
                        </div>
                        <a href="{{ route('admin.transcript.download', $transcriptRequest->id) }}"
                            style="background-color: #16a34a;"
                            class="text-white text-sm font-semibold px-5 py-2 rounded-lg hover:opacity-90 transition w-full sm:w-auto text-center">
                            Download PDF
                        </a>
                    </div>
                @else
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-gray-700">No transcript generated yet</p>
                            <p class="text-xs text-gray-500 mt-1">Make sure payment is confirmed and results are uploaded before generating.</p>
                        </div>
                        <form method="POST" action="{{ route('admin.transcript.generate', $transcriptRequest->id) }}" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="bg-purple-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:opacity-90 transition w-full sm:w-auto">
                                Generate Transcript
                            </button>
                        </form>
                    </div>
                @endif
                --}}
            </div>

        </div>
    </div>
</x-app-layout>