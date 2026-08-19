<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Transcript Requests
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="overflow-x-auto -mx-6 px-6 sm:mx-0 sm:px-0">
                    <table class="w-full text-left border-collapse min-w-[640px]">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Reference</th>
                                <th class="py-2">Student</th>
                                <th class="py-2">Matric No</th>
                                <th class="py-2">Purpose</th>
                                <th class="py-2">Payment</th>
                                <th class="py-2">Status</th>
                                <th class="py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($requests as $req)
                                <tr class="border-b">
                                    <td class="py-2">{{ $req->reference_number }}</td>
                                    <td class="py-2">{{ $req->student->user->name }}</td>
                                    <td class="py-2">{{ $req->student->matric_number }}</td>
                                    <td class="py-2">{{ str_replace('_', ' ', ucfirst($req->purpose)) }}</td>
                                    <td class="py-2">{{ $req->payment ? ucfirst($req->payment->status) : 'N/A' }}</td>
                                    <td class="py-2">{{ str_replace('_', ' ', ucfirst($req->status)) }}</td>
                                    <td class="py-2">
                                        <a href="{{ route('admin.transcript-requests.show', $req->id) }}" class="text-primary-600 underline">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="py-4 text-center text-gray-500">No requests yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $requests->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>