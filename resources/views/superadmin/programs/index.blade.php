<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Programs</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-50 text-green-800 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('superadmin.programs.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-md inline-block mb-4">
                    + Add Program
                </a>

                <div class="overflow-x-auto -mx-6 px-6 sm:mx-0 sm:px-0">
                    <table class="w-full text-left border-collapse min-w-[600px]">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Name</th>
                                <th class="py-2">Code</th>
                                <th class="py-2">Department</th>
                                <th class="py-2">Level</th>
                                <th class="py-2">Duration</th>
                                <th class="py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($programs as $program)
                                <tr class="border-b">
                                    <td class="py-2">{{ $program->program_name }}</td>
                                    <td class="py-2">{{ $program->program_code }}</td>
                                    <td class="py-2">{{ $program->department }}</td>
                                    <td class="py-2">{{ $program->level }}</td>
                                    <td class="py-2">{{ $program->duration_years }} yrs</td>
                                    <td class="py-2">
                                        <form method="POST" action="{{ route('superadmin.programs.destroy', $program->id) }}" onsubmit="return confirm('Remove this program?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 underline">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="py-4 text-center text-gray-500">No programs yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>