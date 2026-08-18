<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Results for {{ $student->user->name }} ({{ $student->matric_number }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-50 text-green-800 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.results.store', $student->id) }}" class="mb-8 p-4 bg-gray-50 rounded-md">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Course</label>
                            <select name="course_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Select Course --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_code }} - {{ $course->course_title }} ({{ $course->credit_unit }} units)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Score (0-100)</label>
                            <input type="number" name="score" min="0" max="100" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Academic Session</label>
                            <input type="text" name="academic_session" placeholder="2023/2024" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Level</label>
                            <select name="level" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="300">300</option>
                                <option value="400">400</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Semester</label>
                            <select name="semester" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="first">First</option>
                                <option value="second">Second</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                        Add Result
                    </button>
                </form>

                <h3 class="text-lg font-semibold mb-4">Existing Results</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Course</th>
                            <th class="py-2">Score</th>
                            <th class="py-2">Grade</th>
                            <th class="py-2">GP</th>
                            <th class="py-2">Session</th>
                            <th class="py-2">Level</th>
                            <th class="py-2">Semester</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $result)
                            <tr class="border-b">
                                <td class="py-2">{{ $result->course->course_code }}</td>
                                <td class="py-2">{{ $result->score }}</td>
                                <td class="py-2">{{ $result->grade }}</td>
                                <td class="py-2">{{ $result->grade_point }}</td>
                                <td class="py-2">{{ $result->academic_session }}</td>
                                <td class="py-2">{{ $result->level }}</td>
                                <td class="py-2">{{ ucfirst($result->semester) }}</td>
                                <td class="py-2">
                                    <form method="POST" action="{{ route('admin.results.destroy', $result->id) }}" onsubmit="return confirm('Delete this result?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="py-4 text-center text-gray-500">No results yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>