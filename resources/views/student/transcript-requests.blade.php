<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Transcript Requests
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('student.transcript.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-md inline-block mb-4">
                    + New Request
                </a>

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
                        @forelse ($requests as $req)
                            <tr class="border-b">
                                <td class="py-2">{{ $req->reference_number }}</td>
                                <td class="py-2">{{ str_replace('_', ' ', ucfirst($req->purpose)) }}</td>
                                <td class="py-2">
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
                                    <span class="px-2 py-1 rounded-full text-xs {{ $statusColors[$req->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ str_replace('_', ' ', ucfirst($req->status)) }}
                                    </span>
                                </td>
                                <td class="py-2">{{ $req->created_at->format('d M Y') }}</td>
                                <td class="py-2">
                                    @if ($req->status === 'completed' && $req->transcript)
                                        <a href="{{ route('student.transcript.download', $req->id) }}" class="text-green-600 underline">Download PDF</a>
                                    @elseif ($req->payment && $req->payment->status === 'pending')
                                        <a href="{{ route('student.transcript.payment', $req->id) }}" class="text-blue-600 underline">Complete Payment</a>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-4 text-center text-gray-500">No requests yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>