<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Request Transcript
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('student.transcript.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Purpose of Request</label>
                        <select name="purpose" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="employment">Employment</option>
                            <option value="further_studies">Further Studies</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Destination Address (where transcript should be sent)</label>
                        <textarea name="destination_address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3"></textarea>
                    </div>

                    <div class="mb-4 p-4 bg-blue-50 rounded-md text-sm text-blue-800">
                        A processing fee of <strong>₦5,000</strong> applies. You'll be directed to payment after submitting this request.
                    </div>

                    <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                        Submit Request
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>