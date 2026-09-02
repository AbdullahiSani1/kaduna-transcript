<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Transcript Requests
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('student.transcript.create') }}" class="bg-primary-600 text-white px-4 py-2.5 rounded-md inline-block mb-4 text-sm sm:text-base active:bg-primary-700">
                    + New Request
                </a>

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

                @if ($requests->isEmpty())
                    <div class="text-center py-10 text-gray-500 text-sm">No requests yet.</div>
                @else
                    {{-- Mobile: stacked cards --}}
                    <div class="space-y-3 md:hidden">
                        @foreach ($requests as $req)
                            <div class="border border-gray-100 rounded-xl p-4 bg-gray-50">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <p class="font-medium text-gray-800 text-sm truncate">{{ $req->reference_number }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ str_replace('_', ' ', ucfirst($req->purpose)) }}</p>
                                    </div>
                                    <span class="shrink-0 px-2 py-1 rounded-full text-xs {{ $statusColors[$req->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ str_replace('_', ' ', ucfirst($req->status)) }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-200">
                                    <span class="text-xs text-gray-500">{{ $req->created_at->format('d M Y') }}</span>
                                    {{-- Download link removed: applications are processed manually now,
                                         no transcript file is ever attached to $req->transcript. --}}
                                    @if ($req->payment && $req->payment->status === 'pending')
                                        <a href="{{ route('student.transcript.payment', $req->id) }}" class="text-blue-600 text-sm font-medium underline">Complete Payment</a>
                                    @else
                                        <span class="text-gray-400 text-sm">—</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Desktop/tablet: table --}}
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2">Reference</th>
                                    <th class="py-2">Purpose</th>
                                    <th class="py-2">Status</th>
                                    <th class="py-2">Date</th>
                                    <th class="py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $req)
                                    <tr class="border-b">
                                        <td class="py-2">{{ $req->reference_number }}</td>
                                        <td class="py-2">{{ str_replace('_', ' ', ucfirst($req->purpose)) }}</td>
                                        <td class="py-2">
                                            <span class="px-2 py-1 rounded-full text-xs {{ $statusColors[$req->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ str_replace('_', ' ', ucfirst($req->status)) }}
                                            </span>
                                        </td>
                                        <td class="py-2">{{ $req->created_at->format('d M Y') }}</td>
                                        <td class="py-2">
                                            {{-- Download link removed: applications are processed manually now,
                                                 no transcript file is ever attached to $req->transcript. --}}
                                            @if ($req->payment && $req->payment->status === 'pending')
                                                <a href="{{ route('student.transcript.payment', $req->id) }}" class="text-blue-600 underline">Complete Payment</a>
                                            @else
                                                <span class="text-gray-400">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>