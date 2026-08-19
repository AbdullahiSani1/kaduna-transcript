<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Courses</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-50 text-green-800 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('admin.courses.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-md inline-block mb-4">
                    + Add Course
                </a>

                <div class="overflow-x-auto -mx-6 px-6 sm:mx-0 sm:px-0">
                    <table class="w-full text-left border-collapse min-w-[560px]">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Code</th>
                                <th class="py-2">Title</th>
                                <th class="py-2">Units</th>
                                <th class="py-2">Program</th>
                                <th class="py-2">Level</th>
                                <th class="py-2">Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courses as $course)
                                <tr class="border-b">
                                    <td class="py-2">{{ $course->course_code }}</td>
                                    <td class="py-2">{{ $course->course_title }}</td>
                                    <td class="py-2">{{ $course->credit_unit }}</td>
                                    <td class="py-2">{{ $course->program->program_code }}</td>
                                    <td class="py-2">{{ $course->level }}</td>
                                    <td class="py-2">{{ ucfirst($course->semester) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="py-4 text-center text-gray-500">No courses yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $courses->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>