<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Student Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 bg-green-50 text-green-800 rounded-xl border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Welcome Banner --}}
            <div class="bg-primary-700 sm:rounded-2xl p-6 text-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-4">
                    <img src="/images/KADPOLY_LOGO.jpg" alt="KadPoly" class="w-16 h-16 object-contain rounded-full bg-white p-1">
                    <div>
                        <h2 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}!</h2>
                        <p class="text-primary-200 text-sm mt-1">
                            {{ auth()->user()->student->program->program_name ?? 'Student' }} |
                            Matric No: {{ auth()->user()->student->matric_number ?? 'N/A' }}
                        </p>
                        <p class="text-primary-300 text-xs mt-1">Kaduna Polytechnic - College of Science & Technology</p>
                    </div>
                </div>
                <a href="{{ route('student.transcript.create') }}"
                    style="background-color: white; color: #15803d;"
                    class="font-semibold px-6 py-3 rounded-xl hover:opacity-90 transition text-sm whitespace-nowrap">
                    + New Transcript Request
                </a>
            </div>

            {{-- Stats Cards --}}
            @php
                $student = auth()->user()->student;
                $requests = $student ? $student->transcriptRequests()->with('payment', 'transcript')->latest()->get() : collect();
                $total = $requests->count();
                $pending = $requests->whereIn('status', ['pending', 'payment_confirmed', 'processing', 'ready'])->count();
                $completed = $requests->where('status', 'completed')->count();
                $cgpa = $student ? $student->calculateCGPA() : 0;
                $classification = $student ? $student->getClassification($cgpa) : 'N/A';
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                    <p class="text-3xl font-bold text-primary-700">{{ $total }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total Requests</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                    <p class="text-3xl font-bold text-yellow-600">{{ $pending }}</p>
                    <p class="text-sm text-gray-500 mt-1">In Progress</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                    <p class="text-3xl font-bold text-green-600">{{ $completed }}</p>
                    <p class="text-sm text-gray-500 mt-1">Completed</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                    <p class="text-3xl font-bold text-primary-700">{{ $cgpa }}</p>
                    <p class="text-sm text-gray-500 mt-1">Current CGPA</p>
                </div>
            </div>

            {{-- Academic Summary + Recent Requests --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Academic Summary --}}
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="font-semibold text-gray-800 mb-4">Academic Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Program</span>
                            <span class="font-medium text-gray-800">{{ $student->program->program_name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Matric Number</span>
                            <span class="font-medium text-gray-800">{{ $student->matric_number ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Admission Year</span>
                            <span class="font-medium text-gray-800">{{ $student->admission_year ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">CGPA</span>
                            <span class="font-bold text-primary-700">{{ $cgpa }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Classification</span>
                            <span class="font-bold text-primary-700">{{ $classification }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Total Results</span>
                            <span class="font-medium text-gray-800">{{ $student->results->count() }} courses</span>
                        </div>
                    </div>

                    {{-- CGPA Progress Bar --}}
                    <div class="mt-5">
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>CGPA Progress</span>
                            <span>{{ $cgpa }} / 4.00</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5">
                            <div class="bg-primary-600 h-2.5 rounded-full transition-all"
                                style="width: {{ ($cgpa / 4) * 100 }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Recent Requests --}}
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-800">Recent Transcript Requests</h3>
                        <a href="{{ route('student.transcript.requests') }}" class="text-sm text-primary-600 hover:underline">View All</a>
                    </div>

                    @if ($requests->isEmpty())
                        <div class="text-center py-10">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-gray-400 text-sm">No transcript requests yet.</p>
                            <a href="{{ route('student.transcript.create') }}" class="text-primary-600 text-sm hover:underline mt-1 inline-block">Make your first request</a>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach ($requests->take(3) as $req)
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'payment_confirmed' => 'bg-blue-100 text-blue-800',
                                        'processing' => 'bg-purple-100 text-purple-800',
                                        'ready' => 'bg-green-100 text-green-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-100">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">{{ $req->reference_number }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ str_replace('_', ' ', ucfirst($req->purpose)) }} - {{ $req->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="px-2 py-1 rounded-full text-xs {{ $statusColors[$req->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ str_replace('_', ' ', ucfirst($req->status)) }}
                                        </span>
                                        @if ($req->status === 'completed' && $req->transcript)
                                            <a href="{{ route('student.transcript.download', $req->id) }}" class="text-xs text-primary-600 hover:underline">Download</a>
                                        @elseif ($req->payment && $req->payment->status === 'pending')
                                            <a href="{{ route('student.transcript.payment', $req->id) }}" class="text-xs text-blue-600 hover:underline">Pay Now</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <a href="{{ route('student.transcript.create') }}" class="flex flex-col items-center gap-2 p-4 bg-primary-50 rounded-xl hover:bg-primary-100 transition text-center">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="text-sm font-medium text-primary-700">New Request</span>
                    </a>
                    <a href="{{ route('student.transcript.requests') }}" class="flex flex-col items-center gap-2 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition text-center">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span class="text-sm font-medium text-blue-700">My Requests</span>
                    </a>
                    @if ($completed > 0)
                        @php $lastCompleted = $requests->where('status', 'completed')->first(); @endphp
                        <a href="{{ route('student.transcript.download', $lastCompleted->id) }}" class="flex flex-col items-center gap-2 p-4 bg-green-50 rounded-xl hover:bg-green-100 transition text-center">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-sm font-medium text-green-700">Download Transcript</span>
                        </a>
                    @else
                        <div class="flex flex-col items-center gap-2 p-4 bg-gray-50 rounded-xl text-center opacity-50 cursor-not-allowed">
                            <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-400">Download Transcript</span>
                        </div>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-2 p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition text-center">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="text-sm font-medium text-purple-700">My Profile</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>