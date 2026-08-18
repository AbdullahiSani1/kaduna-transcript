<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
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
            <div class="bg-primary-700 rounded-2xl p-6 text-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-4">
                    <img src="/images/KADPOLY_LOGO.jpg" alt="KadPoly" class="w-16 h-16 object-contain rounded-full bg-white p-1">
                    <div>
                        <h2 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}!</h2>
                        <p class="text-primary-200 text-sm mt-1">
                            {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }} -
                            Kaduna Polytechnic Transcript System
                        </p>
                        <p class="text-primary-300 text-xs mt-1">College of Science & Technology</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-primary-200 text-sm">{{ now()->format('l, d M Y') }}</p>
                    <p class="text-primary-300 text-xs mt-1">{{ now()->format('h:i A') }}</p>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 text-center">
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['total_requests'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Total Requests</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 text-center">
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Pending</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 text-center">
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['payment_confirmed'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Payment Confirmed</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 text-center">
                    <p class="text-3xl font-bold text-primary-600">{{ $stats['completed'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Completed</p>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                    <a href="{{ route('admin.transcript-requests.index') }}" class="flex flex-col items-center gap-2 p-4 bg-primary-50 rounded-xl hover:bg-primary-100 transition text-center">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="text-sm font-medium text-primary-700">Transcript Requests</span>
                    </a>

                    <a href="{{ route('admin.results.index') }}" class="flex flex-col items-center gap-2 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition text-center">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="text-sm font-medium text-blue-700">Manage Results</span>
                    </a>

                    <a href="{{ route('admin.courses.index') }}" class="flex flex-col items-center gap-2 p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition text-center">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="text-sm font-medium text-purple-700">Courses</span>
                    </a>

                    @if (auth()->user()->role === 'super_admin')
                        <a href="{{ route('superadmin.admins.index') }}" class="flex flex-col items-center gap-2 p-4 bg-orange-50 rounded-xl hover:bg-orange-100 transition text-center">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-sm font-medium text-orange-700">Manage Admins</span>
                        </a>
                    @else
                        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-2 p-4 bg-orange-50 rounded-xl hover:bg-orange-100 transition text-center">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="text-sm font-medium text-orange-700">My Profile</span>
                        </a>
                    @endif

                </div>

                @if (auth()->user()->role === 'super_admin')
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-4">
                        <a href="{{ route('superadmin.programs.index') }}" class="flex flex-col items-center gap-2 p-4 bg-teal-50 rounded-xl hover:bg-teal-100 transition text-center">
                            <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span class="text-sm font-medium text-teal-700">Manage Programs</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-2 p-4 bg-orange-50 rounded-xl hover:bg-orange-100 transition text-center">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="text-sm font-medium text-orange-700">My Profile</span>
                        </a>
                    </div>
                @endif
            </div>

            {{-- Recent Requests Table --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-800">Recent Transcript Requests</h3>
                    <a href="{{ route('admin.transcript-requests.index') }}" class="text-sm text-primary-600 hover:underline">View All</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="pb-3 text-xs font-semibold text-gray-500 uppercase">Reference</th>
                                <th class="pb-3 text-xs font-semibold text-gray-500 uppercase">Student</th>
                                <th class="pb-3 text-xs font-semibold text-gray-500 uppercase">Matric No</th>
                                <th class="pb-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                                <th class="pb-3 text-xs font-semibold text-gray-500 uppercase">Date</th>
                                <th class="pb-3 text-xs font-semibold text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($recentRequests as $req)
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
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-3 text-sm font-medium text-gray-800">{{ $req->reference_number }}</td>
                                    <td class="py-3 text-sm text-gray-600">{{ $req->student->user->name }}</td>
                                    <td class="py-3 text-sm text-gray-600">{{ $req->student->matric_number }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 rounded-full text-xs {{ $statusColors[$req->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ str_replace('_', ' ', ucfirst($req->status)) }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-sm text-gray-500">{{ $req->created_at->format('d M Y') }}</td>
                                    <td class="py-3">
                                        <a href="{{ route('admin.transcript-requests.show', $req->id) }}" class="text-sm text-primary-600 hover:underline">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-gray-400 text-sm">No requests yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>